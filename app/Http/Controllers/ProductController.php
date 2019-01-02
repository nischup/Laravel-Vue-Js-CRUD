<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\User;
use App\Product;
use Session;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Product::latest()->get();
        }
        return view('products.products');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|numeric',
        ]);
        $data = [
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
        ];

        $result = Product::create($data);

        return response()->json($result, 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->save();

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('success', 200);
    }
}
