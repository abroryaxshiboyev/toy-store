@extends('layouts.app')

@section('content')
    <h1>O'yinchoqni Tahrirlash</h1>
    <form action="{{ route('admin.toys.update', $toy) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for Franshiza: "universal"='name' class="form-label">Nomi</label>
            <input type="text" name="name" class="form-control" value="{{ $toy->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Tavsif</label>
            <textarea name="description" class="form-control">{{ $toy->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Narxi</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $toy->price }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Rasm</label>
            <input type="file" name="image" class="form-control">
            @if($toy->image)
                <img src="{{ asset('storage/' . $toy->image) }}" width="100" alt="{{ $toy->name }}" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-success">Yangilash</button>
    </form>
@endsection