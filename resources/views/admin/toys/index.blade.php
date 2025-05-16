@extends('layouts.app')

@section('content')
    <h1>Admin Paneli - O'yinchoqlar</h1>
    <a href="{{ route('admin.toys.create') }}" class="btn btn-primary mb-3">Yangi o'yinchoq qo'shish</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomi</th>
                <th>Narxi</th>
                <th>Rasm</th>
                <th>Amallar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($toys as $toy)
                <tr>
                    <td>{{ $toy->id }}</td>
                    <td>{{ $toy->name }}</td>
                    <td>${{ $toy->price }}</td>
                    <td>
                        @if($toy->image)
                            <img src="{{ asset('storage/' . $toy->image) }}" width="50" alt="{{ $toy->name }}">
                        @else
                            Rasm yo'q
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.toys.edit', $toy->id) }}" class="btn btn-sm btn-warning">Tahrirlash</a>
                        <form action="{{ route('admin.toys.destroy', $toy->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('O\'chirishni tasdiqlaysizmi?')">O'chirish</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Hozircha o'yinchoqlar yo'q</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $toys->links() }}
    </div>
@endsection