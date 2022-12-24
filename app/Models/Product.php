<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static $product,$image,$imageName,$directory,$imageUrl;

    public static function saveProduct($request)
    {
       self::$product = new Product();

       self::$product->product_name = $request->product_name;
       self::$product->category_name = $request->category_name;
       self::$product->brand_name = $request->brand_name;
       self::$product->product_price = $request->product_price;
        self::$product->description = $request->description;
       if ($request->file('image'))
       {
           self::$product->image = self::saveImage($request);
       }
       self::$product->save();
    }
    private static function saveImage($request)
    {
        self::$image = $request->file('image');
        if (self::$image)
        {
            if (self::$product)
            {
                if (file_exists(self::$product->image))
                {
                    unlink(self::$product->image);
                }
            }
        self::$imageName = rand().'.'.self::$image->getClientoriginalExtension();
        self::$directory = 'adminAsset/product_image/';
        self::$imageUrl = self::$directory.self::$imageName;
        self::$image->move(self::$directory,self::$imageName);
        }
        else
        {
            self::$imageUrl = self::$product->image;
        }
        return self::$imageUrl;
    }
    public static function status($id)
    {
        self::$product = Product::find($id);
        if (self::$product->status == 1)
        {
            self::$product->status = 2;
        }
        else
        {
            self::$product->status = 1;
        }
        self::$product->save();
    }
    public static function deleteProduct($request)
    {
        self::$product = Product::find($request->product_id);
        if (self::$product->image)
        {
            if (file_exists(self::$product->image))
            {
                unlink(self::$product->image);
            }
        }
        self::$product->delete();
        return back();
    }
    public static function updateProduct($request)
    {
        self::$product = Product::find($request->product_id);

        self::$product->product_name = $request->product_name;
        self::$product->category_name = $request->category_name;
        self::$product->brand_name = $request->brand_name;
        self::$product->product_price = $request->product_price;
        self::$product->description = $request->description;
        if ($request->file('image'))
        {
            self::$product->image = self::saveImage($request);
        }
        self::$product->save();
    }
}
