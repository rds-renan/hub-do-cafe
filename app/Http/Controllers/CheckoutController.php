<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartController = new CartController();
        $cartData = $cartController->getCartData()->getData();

        $addresses = [];
        if (Auth::check()) {
            $addresses = Auth::user()->addresses()
                ->orderByDesc('is_default')
                ->get()
                ->map(fn($address) => [
                    'id' => $address->id,
                    'label' => $address->label,
                    'street' => $address->street,
                    'number' => $address->number,
                    'complement' => $address->complement,
                    'neighborhood' => $address->neighborhood,
                    'city' => $address->city,
                    'state' => $address->state,
                    'zipcode' => $address->zipcode,
                    'lat' => (float) $address->latitude,
                    'lng' => (float) $address->longitude,
                    'isDefault' => $address->is_default,
                ])
                ->toArray();
        }

        return view('frontend.cart.checkout', [
            'cart' => session()->get('cart', []),
            'cartSubtotal' => $cartData->cartSubtotal,
            'shipping' => $cartData->shipping,
            'cartTotal' => $cartData->cartTotal,
            'addresses' => $addresses
        ]);
    }
}
