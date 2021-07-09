<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(){
        return $this->middleware('auth:admin');
    }

    public function index(){
        $products = Product::get();
        return view('admin.merch.index', compact('products'));
    }

    public function create(){
        return view('admin.merch.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'picture'=>'required',
            'desc'=>'required',
            'price'=>'required'
        ]);
        $path = $data['picture']->store('/public/products');
        $arrpath = explode('/',$path);
        $endpath = end($arrpath);
        $data['picture'] = '/storage/products/'.$endpath;

        Product::create($data);
        toast('product added', 'success');
        return back();
    }
}
