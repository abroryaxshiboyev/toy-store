<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
public function index()
{
    $cart = session()->get('cart', []);
    $toys = Toy::whereIn('id', array_keys($cart))->get()->keyBy('id');
    return view('cart.index', compact('cart', 'toys'));
}

public function add(Request $request): RedirectResponse
{
    $request->validate([
        'toy_id' => 'required|exists:toys,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $cart = session()->get('cart', []);
    $toyId = $request->toy_id;
    $quantity = $request->quantity;

    if (isset($cart[$toyId])) {
        $cart[$toyId]['quantity'] += $quantity;
    } else {
        $cart[$toyId] = ['quantity' => $quantity];
    }

    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'O\'yinchoq korzinkaga qo\'shildi!');
}

    public function remove(Request $request): RedirectResponse
    {
        $request->validate([
            'toy_id' => 'required|exists:toys,id',
        ]);

        $cart = session()->get('cart', []);
        $toyId = $request->toy_id;

        if (isset($cart[$toyId])) {
            unset($cart[$toyId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'O\'yinchoq korzinkadan o\'chirildi!');
    }
}