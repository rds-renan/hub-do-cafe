<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = ProductModel::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Produto adicionado ao carrinho!',
                'cartCount' => count(session()->get('cart'))
            ]);
        }

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function index()
    {
        return view('frontend.cart.review');
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produto removido do carrinho.');
        }
    }
}
