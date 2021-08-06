<?php

namespace App\Http\Controllers;

use App\Product;

class ApiProductsController extends Controller
{
    public function getProducts()
    {
        $products = Product::get();

        return response([
            'products' => $products,
            'result' => 200,
        ], 200);
    }

    public function showProduct($id)
    {
        $product = Product::find($id);
        return response([
            'product' => $product,
            'result' => 200,
        ], 200);
    }
}
