<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'toy_id' => 'required|exists:toys,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|regex:/^\d{9}$/',
            'quantity' => 'required|integer|min:1',
        ]);

        $toy = Toy::findOrFail($validated['toy_id']);
        $totalPrice = $toy->price * $validated['quantity'];

        Order::create([
            'toy_id' => $validated['toy_id'],
            'customer_name' => $validated['customer_name'],
            'customer_phone' => '+998' . $validated['customer_phone'], // +998 qo'shish
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('toys.show', $toy->id)->with('success', 'Buyurtma muvaffaqiyatli qabul qilindi!');
    }
}