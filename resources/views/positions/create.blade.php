@extends('layouts.app')

@section('title', 'Új munkakör létrehozása')

@section('content')
    @can('admin', App\Models\User::class)
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Új munkakör létrehozása</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('positions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Munkakör neve:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Létrehozás</button>
                        <a href="{{ route('positions.index') }}" class="btn btn-secondary btn-block mt-2">Vissza a munkakörök
                            listájához</a>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @cannot('admin', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod munkakör létrehozására!</div>
    @endcannot
@endsection
