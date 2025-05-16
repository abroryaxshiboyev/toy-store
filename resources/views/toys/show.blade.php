@extends('layouts.app')

@section('content')
    <h1>{{ $toy->name }}</h1>
    <div class="card mb-3">
        <img src="{{ asset('storage/' . $toy->image) }}" class="card-img-top" alt="{{ $toy->name }}" style="max-width: 300px;">
        <div class="card-body">
            <h5 class="card-title">{{ $toy->name }}</h5>
            <p class="card-text">{{ $toy->description }}</p>
            <p class="card-text"><strong>Narxi:</strong> ${{ $toy->price }}</p>
        </div>
    </div>

    <h2>Korzinkaga qo'shish</h2>
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="quantity" class="form-label">Soni</label>
            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}" min="1" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <input type="hidden" name="toy_id" value="{{ $toy->id }}">
        <button type="submit" class="btn btn-primary">Korzinkaga qo'shish</button>
    </form>
    <a href="{{ route('cart.index') }}" class="btn btn-secondary mt-3">Korzinkani ko'rish</a>
@endsection