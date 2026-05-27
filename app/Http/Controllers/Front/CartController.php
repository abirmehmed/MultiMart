<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('front.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->featured_image,
                'slug' => $product->slug
            ];
        }

        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated!');
        }
        
        return redirect()->back()->with('error', 'Item not found in cart.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item removed.');
        }
        
        return redirect()->back()->with('error', 'Item not found.');
    }
}