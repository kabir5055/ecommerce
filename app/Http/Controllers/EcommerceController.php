<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        return view('frontEnd.home.home',[
            'products' => Product::where('status',1)
            ->orderby('id','desc')
            ->get(),
        ]);
    }
    public function singleProduct($id)
    {
        $product = Product::find($id);

        $CatBrandWiseProducts = Product::where('category_name',$product->category_name)
            ->orwhere('brand_name',$product->brand_name)
            ->orderby('id','desc')
            ->get();
        return view('frontEnd.product.single-product',[
            'product' => $product,
            'CatBrandWiseProducts' => $CatBrandWiseProducts,
        ]);
    }
}
