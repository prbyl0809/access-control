@extends('layouts.app')

@section('title', 'Szoba szerkesztése')

@section('content')
    @can('admin', App\Models\User::class)
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Szoba szerkesztése</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Szoba neve:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="description">Leírás:</label>
                            <input type="text" class="form-control" id="description" name="description"
                                value="{{ $room->description }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Kép:</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            <small class="form-text text-muted">Ha új képet töltesz fel, a régi kép törlődik.</small>
                        </div>

                        <div class="form-group">
                            <label for="positions">Jogosult munkakörök:</label>
                            <select name="positions[]" id="positions" class="form-control" multiple>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ $room->positions->contains($position->id) ? 'selected' : '' }}>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Tartsd lenyomva a Ctrl vagy Command gombot több munkakör
                                kiválasztásához.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Mentés</button>
                    </form>
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary btn-block mt-2">Vissza</a>

                </div>
            </div>
        </div>
    @endcan

    @cannot('admin', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod a szoba szerkesztésére!</div>
    @endcannot
@endsection
