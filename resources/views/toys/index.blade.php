@extends('layouts.app')

@section('content')
    <h1>O'yinchoqlar</h1>
    <div class="row">
        @forelse($toys as $toy)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $toy->image) }}" class="card-img-top" alt="{{ $toy->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $toy->name }}</h5>
                        <p class="card-text">{{ Str::limit($toy->description, 100) }}</p>
                        <p class="card-text"><strong>Narxi:</strong> ${{ $toy->price }}</p>
                        <a href="{{ route('toys.show', $toy->id) }}" class="btn btn-primary">Batafsil</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Hozircha o'yinchoqlar yo'q.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $toys->links() }}
    </div>
@endsection