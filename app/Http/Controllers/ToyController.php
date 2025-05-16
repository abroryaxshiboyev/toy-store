<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;

class ToyController extends Controller
{
    public function index()
    {
        $toys = Toy::paginate(); // Har sahifada 10 ta o'yinchoq
        return view('toys.index', compact('toys'));
    }

    public function show(Toy $toy)
    {
        return view('toys.show', compact('toy'));
    }
}