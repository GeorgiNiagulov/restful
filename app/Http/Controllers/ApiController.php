<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ApiController extends Controller
{
  public function getAllProducts() {
    $products = Product::get()->toJson(JSON_PRETTY_PRINT);
    return response($products, 200);
  }

  public function createProduct(Request $request) {
    $product = new Product;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->active = $request->active;
    $product->user_id = $request->user_id;
    $product->save();

    return response()->json([
      "message" => "Product record created"
    ], 201);
  }

  public function getProduct($id) {
    if (Product::where('id', $id)->exists()) {
      $product = Product::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($product, 200);
    } else {
      return response()->json([
        "message" => "Product not found"
      ], 404);
    }
  }

  public function updateProduct(Request $request, $id) {
    if(Product::where('id', $id)->exists()) {
      $product = Product::find($id);
      $product->name = is_null($request->name) ? $product->name : $request->name;
      $product->description = is_null($request->description) ? $product->description : $request->description;
      $product->price = is_null($request->price) ? $product->price : $request->price;
      $product->active = is_null($request->active) ? $product->active : $request->active;
      $product->user_id = is_null($request->user_id) ? $product->user_id : $request->user_id;
      $product->save();

      return response()->json([
        "message" => "Product updated succesfully"
      ], 200);
    } else {
      return response()->json([
        "message" => "Product not found"
      ], 404);
    }
  }

  public function deleteProduct($id) {
    if(Product::where('id', $id)->exists()) {
      $product = Product::find($id);
      $product->delete();

      return response()->json([
        "message" => "Product deleted succesfully"
      ], 202);
    } else {
      return response()->json([
        "message" => "Product not found"
      ], 404);
    }
  }
}
