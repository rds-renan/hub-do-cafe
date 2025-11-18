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
            'quantity' => 'nullable|integer|min:1'
        ]);

        $product = ProductModel::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        // Calcula os totais
        $cartCount = $this->getCartCount($cart);
        $cartTotal = $this->getCartTotal($cart);
        $cartSubtotal = $this->getCartSubtotal($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produto adicionado ao carrinho!',
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,
                'cartSubtotal' => $cartSubtotal,
                'cartFormatted' => [
                    'total' => 'R$ ' . number_format($cartTotal, 2, ',', '.'),
                    'subtotal' => 'R$ ' . number_format($cartSubtotal, 2, ',', '.'),
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    /**
     * Atualiza quantidade de um produto no carrinho
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            $cartCount = $this->getCartCount($cart);
            $cartTotal = $this->getCartTotal($cart);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Quantidade atualizada!',
                    'cartCount' => $cartCount,
                    'cartTotal' => $cartTotal,
                    'itemSubtotal' => $cart[$id]['price'] * $cart[$id]['quantity']
                ]);
            }

            return redirect()->back()->with('success', 'Carrinho atualizado!');
        }

        return response()->json(['success' => false, 'message' => 'Produto não encontrado'], 404);
    }

    /**
     * Remove produto do carrinho
     */
    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            $cartCount = $this->getCartCount($cart);
            $cartTotal = $this->getCartTotal($cart);

            return response()->json([
                'success' => true,
                'message' => 'Produto removido do carrinho!',
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Produto não encontrado'], 404);
    }

    /**
     * Exibe o carrinho
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartTotal = $this->getCartTotal($cart);
        $cartSubtotal = $this->getCartSubtotal($cart);
        $shipping = $this->calculateShipping($cartSubtotal);

        return view('frontend.cart.review', compact('cart', 'cartTotal', 'cartSubtotal', 'shipping'));
    }

    /**
     * Limpa o carrinho
     */
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Carrinho limpo!',
            'cartCount' => 0,
            'cartTotal' => 0
        ]);
    }

    /**
     * Retorna os dados do carrinho em JSON
     */
    public function getCartData()
    {
        $cart = session()->get('cart', []);

        return response()->json([
            'cart' => $cart,
            'cartCount' => $this->getCartCount($cart),
            'cartTotal' => $this->getCartTotal($cart),
            'cartSubtotal' => $this->getCartSubtotal($cart),
            'shipping' => $this->calculateShipping($this->getCartSubtotal($cart))
        ]);
    }

    /**
     * Calcula a quantidade total de itens (soma das quantidades)
     */
    private function getCartCount($cart)
    {
        return array_sum(array_column($cart, 'quantity'));
    }

    /**
     * Calcula o subtotal do carrinho (soma dos produtos sem frete)
     */
    private function getCartSubtotal($cart)
    {
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }

    /**
     * Calcula o total do carrinho (subtotal + frete)
     */
    private function getCartTotal($cart)
    {
        $subtotal = $this->getCartSubtotal($cart);
        $shipping = $this->calculateShipping($subtotal);

        return $subtotal + $shipping;
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

    /**
     * Calcula o valor do frete
     * Você pode personalizar essa lógica conforme sua necessidade
     */
    private function calculateShipping($subtotal)
    {
        // Exemplo: frete grátis acima de R$ 100
        if ($subtotal >= 100) {
            return 0;
        }

        // Frete fixo de R$ 15
        return 15.00;

        // Ou você pode calcular baseado no peso, CEP, etc.
        // return $this->calculateShippingByCep($cep);
    }
}
