<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {

	public function placeOrder(Request $request) {
		$user = Auth::user();
		$user_id = $user['id'];
		$obj = new Order();
		$validatedResponse = $obj->validatePlaceOrderModel($request);
		if ($validatedResponse['code'] == 200) {
			$result = $obj->insertOrderModel($request, $user_id);
		} else {
			$result = ['Error' => $validatedResponse['Message']];
		}

		return $result;
	}

}
