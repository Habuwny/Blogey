<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->authorizeResource(User::class, 'user');
  }

  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }
  public function store(Request $request)
  {
    //
  }

  public function show(User $user)
  {
    return view('users.show', ['user' => $user]);
  }
  public function edit(User $user)
  {
    return view('users.edit', ['user' => $user]);
  }

  public function update(UpdateUser $request, User $user)
  {
    if ($request->hasFile('avatar')) {
      $path = $request->file('avatar')->store('avatars');

      if ($user->image) {
        $user->image->path = $path;
        $user->image->save();
      } else {
        $user->image->save(Image::make(['path' => $path]));
      }
    }

    return redirect()
      ->back()
      ->withStatus('Profile image was updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    //
  }
}
