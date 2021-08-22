<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;

class ApiProductsController extends Controller
{
    //merch
    public function getProducts()
    {
        if (request()->type == 'decor') {
            $products = Product::where('category', 'decor')->get();
        } else if (request()->type == 'clothes') {
            $products = Product::where('category', 'clothes')->get();
        } else {
            $products = Product::where('category', 'merch')->get();
        }

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

    public function purchaseProduct($id)
    {
        $product = Product::find($id);
        $user = User::find(auth()->user()->id);
        if ($product->crystal == 'white') {
            $bal = $user->royalties->white_crystal;
            if ((int) $product->price <= (int) $bal) {
                $newbal = (int) $bal - (int) $product->price;
                $user->royalties->update(['white_crystal' => $newbal]);
                $user->box->products()->attach($id);
            } else {
                return response([
                    'new_balance' => $user->royalties,
                    'result' => 400,
                ], 200);
            }
        } else {
            $bal = $user->royalties->purple_crystal;
            if ((int) $product->price <= (int) $bal) {
                $newbal = (int) $bal - (int) $product->price;
                $user->royalties->update(['purple_crystal' => $newbal]);
                $user->box->products()->attach($id);
            } else {
                return response([
                    'new_balance' => $user->royalties,
                    'result' => 400,
                ], 200);
            }
        }

        return response([
            'new_balance' => $user->royalties,
            'result' => 200,
        ], 200);
    }

    public function getMyProducts()
    {
        $user = User::find(auth()->user()->id);
        if (request()->type == 'decor') {
            $products = $user->box->products()->where('category', 'decor')->get();
        } else if (request()->type == 'clothes') {
            $products = $user->box->products()->where('category', 'clothes')->get();
        } else {
            $products = $user->box->products()->get();
        }

        return response([
            'products' => $products,
            'result' => 200,
        ], 200);
    }
}
