<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model {

	protected $table = 'cart';
	protected $fillable = ['user_id', 'product_id', 'product_title', 'product_description', 'product_price', 'product_logo', 'no_of_items', 'total_amount', 'delete_flag', 'order_status'];

	public function addToCartModel($user_id, $request) {
		$cart = new Cart();
		$cart->user_id = $user_id;
		$cart->product_id = $request->input('id');
		$cart->product_title = $request->input('title');
		$cart->product_description = $request->input('description');
		$cart->product_price = $request->input('price');
		$cart->product_logo = $request->input('logo');
		$cart->no_of_items = $request->input('quantity');
		$cart->save();
		return response()->json($cart);
	}

	public function getCartDetailsByUserIdModel($user_id) {
		$result = DB::table($this->table)
			->where('user_id', $user_id)
			->where('delete_flag', 0)
            ->where('order_status', 0)
			->get();
		return $result;
	}

	public function getTotalAmountModel($user_id) {
		// $amount = 0;
		$amount = DB::table($this->table)
			->where('user_id', $user_id)
			->where('delete_flag', 0)
            ->where('order_status', 0)
			->sum('total_amount');
		return $amount;
	}

	public function deleteCartItemModel($cart_id, $user_id) {
		$result = DB::table($this->table)
			->where('id', $cart_id)
			->where('user_id', $user_id)
			->update(['delete_flag' => 1]);
		return $result;
	}

	public function updateCartItemModel($cart_id, $quantity) {
		$result = DB::table($this->table)
			->where('id', $cart_id)
			->update(['no_of_items' => $quantity]);
		return $result;
	}
}