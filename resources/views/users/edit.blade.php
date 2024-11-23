@extends('layouts.app')

@section('title', 'Dolgozó szerkesztése')

@section('content')
    @can('admin', App\Models\User::class)
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Dolgozó adatainak szerkesztése</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Név:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Telefonszám:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="card_number">Kártyaszám (16 karakter):</label>
                            <input type="text" class="form-control" id="card_number" name="card_number"
                                value="{{ old('card_number', $user->card_number) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="position_id">Munkakör:</label>
                            <select id="position_id" name="position_id" class="form-control" required>
                                <option value="">Válassz munkakört</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ old('position_id', $user->position_id) == $position->id ? 'selected' : '' }}>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Mentés</button>
                    </form>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-block mt-2">Vissza a dolgozók
                        listájához</a>
                </div>
            </div>
        </div>
    @endcan

    @cannot('admin', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod dolgozót szerkeszteni!</div>
    @endcannot
@endsection
