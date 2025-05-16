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
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|regex:/^\d{9}$/',
        'items' => 'required|array',
        'items.*.toy_id' => 'required|exists:toys,id',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    foreach ($validated['items'] as $item) {
        $toy = Toy::findOrFail($item['toy_id']);
        $totalPrice = $toy->price * $item['quantity'];

        Order::create([
            'toy_id' => $item['toy_id'],
            'customer_name' => $validated['customer_name'],
            'customer_phone' => '+998' . $validated['customer_phone'],
            'quantity' => $item['quantity'],
            'total_price' => $totalPrice,
        ]);
    }

    session()->forget('cart');

    return redirect()->route('toys.index')->with('success', 'Buyurtma muvaffaqiyatli qabul qilindi!');
}
}