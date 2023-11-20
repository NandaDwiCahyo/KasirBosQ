<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function cart(Request $request)
    {
        $user = Auth::user();
        $product_stock = Product::select('stock')->get();

        for ($i = 1; $i <= count($request->quantity); $i++) {
            if ($request->quantity[$i] != 0) {
                $cart = new Cart;
                $cart->user_id = $user["id"];
                $cart->category_id = $request->category_id[$i];
                $cart->product_id = $request->product_id[$i];
                $cart->quantity = $request->quantity[$i];
                $cart->save();

                $product = Product::find($request->product_id[$i]);
                $product->stock = $product->stock - $request->quantity[$i];
                $product->save();
            }
        }

        return redirect('/home');
    }

    public function clearCart()
    {
        $carts = DB::table('carts')->join('products', 'carts.product_id', 'products.id')->select('carts.*', 'products.id', 'products.stock')->get();

        for ($i = 0; $i < count($carts); $i++) {
            $product = Product::find($carts[$i]->id);
            $product->stock += $carts[$i]->quantity;
            $product->save();
        }

        Cart::truncate();

        return redirect('/home');
    }

    public function transaction(Request $request)
    {
        $carts = Cart::all();
        $random_code = Str::random(5);

        foreach ($carts as $crt) {
            $transaction = new Transaction;
            $transaction->user_id = $crt->user_id;
            $transaction->category_id = $crt->category_id;
            $transaction->product_id = $crt->product_id;
            $transaction->customer_name = $request->customer_name;
            $transaction->address = $request->address;
            $transaction->quantity = $crt->quantity;
            $transaction->checkout_code = $random_code;
            $transaction->save();
        }

        Cart::truncate();

        return redirect('/home');
    }
}
