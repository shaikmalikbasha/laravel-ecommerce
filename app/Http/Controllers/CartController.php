<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {

	public function addToCart(Request $request) {
		$user = Auth::user();
		$user_id = $user['id'];
		$addCartObj = new Cart();
		$result = $addCartObj->addToCartModel($user_id, $request);
		return $result;
	}

	public function getCartDetailsByUserId() {
		$user = Auth::user();
		$user_id = $user['id'];
		$obj = new Cart();
		$result = $obj->getCartDetailsByUserIdModel($user_id);
		return response()->json($result);
	}

	public function deleteCartItem(Request $request) {
		$user = Auth::user();
		$user_id = $user['id'];
		$cart_id = $request->input('cart_id');
		$cartDeleteObj = new Cart();
		$result = $cartDeleteObj->deleteCartItemModel($cart_id, $user_id);
		return ['code' => 204, 'message' => 'Successfully removed this Item from your cart..'];
	}

	public function updateCartItem(Request $request) {
		$user = Auth::user();
		$quantity = $request->input('no_of_items');
		$cart_id = $request->input('cart_id');
		$updateCartObj = new Cart();
		$result = $updateCartObj->updateCartItemModel($cart_id, $quantity);
		if ($result == 1) { // If success
			return ['code' => 204, 'message' => 'Successfully updated this Item in your cart..'];
		} else {
			return ['Status' => 'Something went wrong..'];
		}
	}

	public function getTotalAmount() {
		$user = Auth::user();
		$user_id = 11;
		$cartObj = new Cart();
		$amount = $cartObj->getTotalAmountModel($user_id);
		return $amount;
	}

}
