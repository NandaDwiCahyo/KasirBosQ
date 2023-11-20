<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $user = Auth::user()->id;

        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')->get();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->where('user_id', $user)
            ->select('products.*', 'categories.category')
            ->get();

        return view("product.index", compact("categories", "products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $product = new Product;
        $product->user_id = $user["id"];
        $product->category_id = $request->category;
        $product->product_name = $request->product_name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->save();

        return redirect('/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::where('id', $id)->get();

        return view('product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $product = Product::find($id);
        $product->user_id = $user["id"];
        $product->category_id = $request->category;
        $product->product_name = $request->product_name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->save();

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect('/product');
    }

    public function search(Request $request)
    {
        $categories = Category::all();

        $user = Auth::user()->id;

        $products = Product::where('category_id', $request->category)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('user_id', $user)
            ->get();

        return view("product.index", compact("categories", "products"));
    }

    public function history()
    {
        $user = Auth::user()->id;

        $transactions = DB::table('transactions')
            ->where('user_id', $user)
            ->groupBy('checkout_code')
            ->get();

        return view('product.history', compact("transactions"));
    }

    public function invoice(string $checkout_code)
    {
        $transactions = DB::table('transactions')
            ->where('checkout_code', $checkout_code)
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->select('transactions.*', 'products.product_name', 'products.price', 'users.name', 'categories.category')
            ->get();

        // return view('invoice', compact('transactions'));

        $pdf = PDF::loadView('invoice', compact('transactions'));

        return $pdf->download('invoice.pdf');
    }
}
