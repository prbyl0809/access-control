@extends('layouts.app')

@section('title', 'Munkakör szerkesztése')

@section('content')
    @can('admin', App\Models\User::class)
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $position->name }} szerkesztése</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('positions.update', $position->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Munkakör neve:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $position->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Mentés</button>
                    </form>
                    <a href="{{ route('positions.index') }}" class="btn btn-secondary btn-block mt-2">Vissza</a>
                </div>
            </div>
        </div>
    @endcan

    @cannot('admin', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod a pozícióhoz szerkesztéséhez!</div>
    @endcannot
@endsection
