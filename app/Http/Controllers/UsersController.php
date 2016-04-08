<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
  public function index($id = null) {

    //To get the authenticated user for this API request,
    $user = Auth::guard('api')->user();

    if ($id == null) {
      //Fields are optinal, this way we show only desired fields
      $users = User::all(array('id', 'name', 'email', 'username'));
    } else {
      $users = User::find($id, array('id', 'name', 'email', 'username'));
    }
    return response()->json(array(
      'error' => false,
      'user' => $user,
      'program' => $users,
      'status_code' => 200
    ));
  }

  public function store(Request $request) {
    return 'UsersController@store';
  }

  public function create() {
    return 'UsersController@create';
  }

  public function update() {
    return 'UsersController@update';
  }

  public function show() {
    return 'UsersController@show';
  }

  public function destroy() {
    return 'UsersController@destroy';
  }

  public function edit() {
    return 'UsersController@edit';
  }
}
