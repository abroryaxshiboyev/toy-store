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

    <h2>Buyurtma berish</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Ismingiz</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" required>
            @error('customer_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="customer_phone" class="form-label">Telefon raqamingiz</label>
            <div class="input-group">
                <span class="input-group-text">+998</span>
                <input type="text" name="customer_phone" id="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" pattern="\d{9}" placeholder="901234567" required>
            </div>
            @error('customer_phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Soni</label>
            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}" min="1" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <input type="hidden" name="toy_id" value="{{ $toy->id }}">
        <button type="submit" class="btn btn-primary">Buyurtma berish</button>
    </form>

    <script>
        document.getElementById('customer_phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, ''); // Faqat raqamlarni olish
            if (value.length > 9) {
                value = value.slice(0, 9); // 9 raqamdan ortiq bo'lmasligi
            }
            e.target.value = value;
        });
    </script>
@endsection