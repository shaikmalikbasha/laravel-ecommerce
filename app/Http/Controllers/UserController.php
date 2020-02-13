<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

	public $successStatus = 200;

	public function login() {
		if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
			$user = Auth::user();
			$token = $user->createToken('MyApp')->accessToken;
			$jsonData = ['token' => $token, 'Message' => 'Login Successfull', 'Code' => 200];
			return response($jsonData);
		} else {
			return response()->json(['Message' => 'Unauthorised User,Please provide proper Details', 'Code' => 401], 401);
		}
	}

	public function register(Request $request) {
		$user = new User();
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->mobile = $request->input('mobile');
		$user->address = $request->input('address');

		$user->save();
		return response()->json($user);
	}

	public function details() {
		$user = Auth::user();
		$user_id = $user['id'];
		return response()->json(['user_id' => $user['id']], $this->successStatus);
	}

	public function hello(Request $request) {
		return response()->json(['Array : ' => $request]);
	}
}
?>
