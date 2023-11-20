<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function index()
    {
        return view("index");
    }

    function home()
    {
        $user = Auth::user()->id;

        $categories = Category::all();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->where('user_id', $user)
            ->select('products.*', 'categories.category')->where('stock', '!=', '0')
            ->get();

        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', 'products.id')
            ->select('carts.*', 'products.product_name', 'products.price')
            ->get();

        return view("home", compact("categories", "products", "carts"));
    }

    public function search(Request $request)
    {
        $categories = Category::all();

        $user = Auth::user()->id;

        $products = Product::where('category_id', $request->category)
            ->where('stock', '!=', '0')->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('user_id', $user)
            ->get();

        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', 'products.id')
            ->select('carts.*', 'products.product_name', 'products.price')
            ->get();

        return view("home", compact("categories", "products", "carts"));
    }
}
