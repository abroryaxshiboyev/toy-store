@extends('layouts.app')

@section('content')
    <h1>Korzinka</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(empty($cart))
        <p>Korzinkangiz bo'sh.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>O'yinchoq</th>
                    <th>Narxi</th>
                    <th>Soni</th>
                    <th>Jami</th>
                    <th>Amallar</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach($cart as $toyId => $item)
                    @php
                        $toy = $toys[$toyId];
                        $subtotal = $toy->price * $item['quantity'];
                        $totalPrice += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $toy->name }}</td>
                        <td>${{ $toy->price }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ $subtotal }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="toy_id" value="{{ $toyId }}">
                                <button type="submit" class="btn btn-sm btn-danger">O'chirish</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Umumiy narx: ${{ number_format($totalPrice, 2) }}</h3>

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
            @foreach($cart as $toyId => $item)
                <input type="hidden" name="items[{{$toyId}}][toy_id]" value="{{ $toyId }}">
                <input type="hidden" name="items[{{$toyId}}][quantity]" value="{{ $item['quantity'] }}">
            @endforeach
            <button type="submit" class="btn btn-primary">Buyurtma berish</button>
        </form>
    @endif
    <a href="{{ route('toys.index') }}" class="btn btn-secondary mt-3">O'yinchoqlarga qaytish</a>

    <script>
        document.getElementById('customer_phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value.length > 9) {
                value = value.slice(0, 9);
            }
            e.target.value = value;
        });
    </script>
@endsection