<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
  public function index($id = null) {

    if ($id == null) {
      //Fields are optinal, this way we show only desired fields
      $users = User::all(array('id', 'name', 'email', 'username'));
    } else {
      $users = User::find($id, array('id', 'name', 'email', 'username'));
    }
    return response()->json(array(
      'error' => false,
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

