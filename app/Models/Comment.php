<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Builder;

class Comment extends Model
{
  use HasFactory;
  use SoftDeletes;

  public function blogPost()
  {
    return $this->belongsTo(BlogPost::class);
  }
  public function scopeLatest(Builder $query)
  {
    return $query->orderBy(static::CREATED_AT, 'desc');
  }
  public static function boot()
  {
    //DELETE RELATED TABLES
    parent::boot();
    //    static::addGlobalScope(new LatestScope());
  }
}
