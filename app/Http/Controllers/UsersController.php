<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersController extends Controller
{
  public function index($id = null)
  {
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

  public function store(Request $request)
  {
//    $validator = Validator::make(Input::all(), [
//      'name' => 'required|max:255',
//      'email' => 'required|email|max:255|unique:users',
//      'username' => 'required|max:38|unique:users',
//      'password' => 'required|min:6|confirmed',
//    ]);

//    $this->validate($request, [
//      'name' => 'required|max:255',
//      'email' => 'required|email|max:255|unique:users',
//      'username' => 'required|max:38|unique:users',
//      'password' => 'required|min:6|confirmed',
//    ]);

//return phpinfo();

    $input = $request->all();

    //User::create($input);

    $fields = [
      'name' => $input['name'],
      'email' => $input['email'],
      'username' => $input['username'],
      'password_plain' => $input['password_plain'],
    ];
    $rules = [
      'name' => 'required|max:20',
      'email' => 'required|email|max:255|unique:users',
      'username' => 'required|max:38|unique:users',
      'password_plain' => 'required|min:6',
    ];
    $valid = Validator::make($fields, $rules);

    if ($valid->errors()->count()) {
      return [
        'message' => 'validation_failed',
        'errors' => $valid->errors()
      ];
    }
    else {
      $user = User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'username' => $input['username'],
        'password_plain' => $input['password_plain'],
        'password' => bcrypt($input['password_plain']),
        'api_token' => str_random(60),
      ]);
      $user->save();
    }


//    User::create([
//      'name' => $request['name'],
//      'email' => $request['email'],
//      'username' => $request['username'],
//      'password_plain' => $request['password'],
//      'password' => bcrypt($request['password']),
//      'api_token' => str_random(60),
//    ]);


    /*
    User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'username' => $data['username'],
      'password_plain' => $data['password'],
      'password' => bcrypt($data['password']),
      'api_token' => str_random(60),
    ]);
    */

//    return Response::make([
//      'message' => 'Validation Failed',
//      'errors' => $validator->errors()
//    ]);

    return response()->json(array(
      'error' => false,
      'user' => $user,
      'status_code' => 200
    ));
  }

  public function create()
  {
    return 'UsersController@create';
  }

  public function update()
  {
    return 'UsersController@update';
  }

  public function show()
  {
    return 'UsersController@show';
  }

  public function destroy()
  {
    return 'UsersController@destroy';
  }

  public function edit()
  {
    return 'UsersController@edit';
  }
}
