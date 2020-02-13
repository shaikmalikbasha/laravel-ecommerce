<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model {
	protected $table = 'orders';
	protected $fillable = ['user_id', 'b_name', 'b_address', 'b_city', 'b_state', 'b_country', 'b_mobile', 'b_email', 's_name', 's_address', 's_city', 's_state', 's_country', 's_mobile', 's_email', 'total_amount', 'name_in_card', 'cart_type'];

	public function insertOrderModel($data, $user_id) {
		$result = '';
		$order = new Order();
		$order->user_id = $user_id;
		$order->b_name = $data['b_name'];
		$order->b_address = $data['b_address'];
		$order->b_city = $data['b_city'];
		$order->b_state = $data['b_state'];
		$order->b_country = $data['b_country'];
		$order->b_mobile = $data['b_mobile'];
		$order->b_email = $data['b_email'];
		$order->s_name = $data['s_name'];
		$order->s_address = $data['s_address'];
		$order->s_city = $data['s_city'];
		$order->s_state = $data['s_state'];
		$order->s_country = $data['s_country'];
		$order->s_mobile = $data['s_mobile'];
		$order->s_email = $data['s_email'];
		$order->total_amount = $data['total_amount'];
		$order->name_in_card = $data['name_in_card'];
		$order->cart_type = $data['cart_type'];
		$res = response()->json($order);
		if ($order->save()) {
			$result = DB::table('cart')
				->where('user_id', $user_id)
				->update(['order_status' => 1]);
			$result = ['Data' => $res, 'code' => 201, 'message' => 'Order created successfully...'];
		}
		return $result;
	}

	public function validatePlaceOrderModel($inputdata) {
		if (!filter_var($inputdata['b_email'], FILTER_VALIDATE_EMAIL) || !filter_var($inputdata['s_email'], FILTER_VALIDATE_EMAIL)) {
			return ['code' => 400, 'message' => "This email does not exists."];
		} else {
			if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $inputdata['s_email']) || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $inputdata['b_email'])) {
				return ['code' => 400, 'message' => "Invalid Email ID please enter valid email ID."];
			}
		}
		if ((!is_numeric($inputdata['b_mobile'])) || (!is_numeric($inputdata['s_mobile']))) {
			return ['code' => 400, 'message' => "Mobile Number contains only Numbers."];
		}
		if (!is_string($inputdata['b_name']) || !is_string($inputdata['s_name'])) {
			return ['code' => 400, 'message' => "Name contains only Alphabets"];
		}
		if (!is_string($inputdata['b_city']) || !is_string($inputdata['s_city'])) {
			return ['code' => 400, 'message' => "City Name contains only Alphabets"];
		}
		if (!is_string($inputdata['b_state']) || !is_string($inputdata['s_state'])) {
			return ['code' => 400, 'message' => "State Name contains only Alphabets"];
		}
		if (!is_string($inputdata['b_country']) || !is_string($inputdata['s_country'])) {
			return ['code' => 400, 'message' => "State Name contains only Alphabets"];
		}
		if (!is_string($inputdata['name_in_card']) || !is_string($inputdata['name_in_card'])) {
			return ['code' => 400, 'message' => "State Name contains only Alphabets"];
		}
		return ['code' => 200, 'Message' => "Valid Data"];
	}

}