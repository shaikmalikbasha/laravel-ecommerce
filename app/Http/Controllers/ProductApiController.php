<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductApiController extends Controller
{
	public function addProduct(Request $request)
	{
		$product = new Products();

		$product->title = $request->input('title');
		$product->description = $request->input('description');
		$product->price = $request->input('price');
		$product->logo = $request->input('logo');
		$product->quantity = $request->input('quantity');

		$product->save();
		return response()->json($product);
	}

	public function homePage()
	{
		$products = Products::all();
		return response()->json($products);
	}

	public function showProductById($id)
	{
		$product = Products::find($id);

		return response()->json($product);
	}

	public function searchProducts(Request $request , $query) 
	{
		$product = Products::where("title","LIKE","%".$query."%")->get();

		return response()->json($product);
	}
	/* This is used to Suggest some products.. */
	public function suggestProducts(Request $request , $query) 
	{
		$product = Products::where("description","LIKE","%".$query."%")->get();

		return response()->json($product);
	}
}
