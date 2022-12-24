<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
        return view('admin.product.add-product');
    }
    public function saveProduct(Request $request)
    {
        Product::saveProduct($request);
        return redirect(route('manage.product'))->with('massage','Saved SuccessFully');
    }
    public function manageProduct()
    {
        $product = Product::all();
        return view('admin.product.manage-product',[
            'products' => $product,
        ]);
    }
    public function status($id)
    {
        Product::status($id);
        return back();
    }
    public function deleteProduct(Request $request)
    {
        Product::deleteProduct($request);
        return redirect(route('manage.product'));
    }
    public function editProduct(Request $request)
    {
       $product = Product::find($request->product_id);
       return view('admin.product.edit',[
           'product' => $product,
       ]);
    }
    public function updateProduct(Request $request)
    {
        Product::updateProduct($request);
        return redirect(route('manage.product'));
    }
}
