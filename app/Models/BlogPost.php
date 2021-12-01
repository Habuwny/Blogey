<?php

namespace App\Models;

use App\Scopes\TrashedAdminScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = ['title', 'content', 'user_id'];

  public function comments()
  {
    return $this->hasMany(Comment::class)->latest();
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  //
  public function tags()
  {
    return $this->belongsToMany(Tag::class)->withTimestamps();
  }

  public function image()
  {
    return $this->morphOne(Image::class, 'imageable');
  }
  public function scopeLatest(Builder $query)
  {
    return $query->orderBy(static::CREATED_AT, 'desc');
  }
  public function scopeMostCommented(Builder $query)
  {
    return $query->withCount('comments')->orderBy('comments_count', 'desc');
  }

  public function scopeLatestWithRelations(Builder $query)
  {
    return $query
      ->latest()
      ->withCount('comments')
      ->with('user')
      ->with('tags');
  }
  public static function boot()
  {
    static::addGlobalScope(new TrashedAdminScope());
    //DELETE RELATED TABLES
    parent::boot();
    static::deleting(function (BlogPost $blogPost) {
      $blogPost->comments()->delete();
      Cache::tags(['blog-post'])->forge("blog-post-{$blogPost->id}");
    });
    //RESTORE FROM TRASH
    static::updating(function (BlogPost $blogPost) {
      Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    });
    static::restoring(function (BlogPost $blogPost) {
      $blogPost->comments()->restore();
    });
  }
}
