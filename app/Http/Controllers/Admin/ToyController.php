<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ToyController extends Controller
{
    public function index()
    {
        $toys = Toy::paginate(); // Har sahifada 10 ta o'yinchoq
        return view('admin.toys.index', compact('toys'));
    }

    public function create()
    {
        return view('admin.toys.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('toys', 'public') : null;

        Toy::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.toys.index')->with('success', 'O\'yinchoq qo\'shildi!');
    }

    public function edit(Toy $toy)
    {
        return view('admin.toys.edit', compact('toy'));
    }

    public function update(Request $request, Toy $toy): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($toy->image) {
                Storage::disk('public')->delete($toy->image);
            }
            $imagePath = $request->file('image')->store('toys', 'public');
        } else {
            $imagePath = $toy->image;
        }

        $toy->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.toys.index')->with('success', 'O\'yinchoq yangilandi!');
    }

    public function destroy(Toy $toy): RedirectResponse
    {
        if ($toy->image) {
            Storage::disk('public')->delete($toy->image);
        }
        $toy->delete();
        return redirect()->route('admin.toys.index')->with('success', 'O\'yinchoq o\'chirildi!');
    }
}