<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();
        return view('frontend.index', compact('product_categories'));
    }
    public function product($id)
    {
        // return $id;
        $product = Product::with('media')->whereId($id)
            ->Active()->HasQuantity()->ActiveCategory()->firstOrFail();

        $relatedProducts = Product::with('firstMedia')->whereHas('category', function ($query) use ($product) {
            $query->whereId($product->product_category_id);
            $query->whereStatus(true);
        })->inRandomOrder()->Active()->HasQuantity()->take(4)->get();
        // return $relatedProducts;
        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function cart()
    {
        return view('frontend.cart');
    }
    public function wishlist()
    {
        return view('frontend.wishlist');
    }

    // public function checkout()
    // {
    //     return view('frontend.checkout');
    // }
   

}
