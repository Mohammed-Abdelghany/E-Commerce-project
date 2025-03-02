<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
  /**
   * Display a listing of the resource.
   */


  /**
   * Store a newly created resource in storage.
   */
  public function register(Request $request)
  {
    //
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:10',
      'email' => 'required|email|max:255',
      'password' => 'required|string|min:8|max:255|confirmed',

    ]);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }
    $access_token = Str::random(64);
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => 'user',
      'access_token' => $access_token,
    ]);
    return response()->json(['message' => 'User created successfully', 'user' => $user, 'access_token' => $access_token], 201);
  }

  /**
   * Display the specified resource.
   */
  public function login(Request $request)
  {
    //
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|max:255',
      'password' => 'required|string|min:8|max:255',
    ]);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }
    $user = User::where('email', $request->email)->first();
    if ($user == null) {
      return response()->json(['message' => 'User not found'], 404);
    }
    if (password_verify($request->password, $user->password)) {
      $access_token = Str::random(64);
      $user->update([
        'access_token' => $access_token,
      ]);
      return response()->json(['message' => 'User logged in successfully', 'user' => $user], 200);
    } else {
      return response()->json(['message' => 'Invalid credentials'], 401);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function logout(Request $request)
  {
    //
    $access_token = $request->header('access_token');
    if ($access_token == null) {
      return response()->json(['message' => 'Access token is required'], 401);
    }
    $user = User::where('access_token', $access_token)->first();
    if ($user == null) {
      return response()->json(['message' => 'User not found'], 404);
    }


    $user->update([
      'access_token' => null,
    ]);
    return response()->json(['message' => 'User logged out successfully'], 200);
  }

  /**
   * Remove the specified resource from storage.
   */
}
