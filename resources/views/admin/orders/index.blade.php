@extends('layouts.app')

@section('content')
    <h1>Admin Paneli - Buyurtmalar</h1>
    <a href="{{ route('admin.toys.index') }}" class="btn btn-secondary mb-3">O'yinchoqlarga qaytish</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>O'yinchoq</th>
                <th>Mijoz ismi</th>
                <th>Telefon raqami</th>
                <th>Soni</th>
                <th>Umumiy narx</th>
                <th>Sana</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->toy->name }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ $order->total_price }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Hozircha buyurtmalar yo'q</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
@endsection