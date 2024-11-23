@extends('layouts.app')

@section('title', 'Belépés szimuláció')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Belépés szimuláció</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('simulate-entry.process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Dolgozó:</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Válassz dolgozót</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}
                                    ({{ $user->position->name ?? 'Nincs pozíció' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="room_id">Szoba:</label>
                        <select name="room_id" id="room_id" class="form-control" required>
                            <option value="">Válassz szobát</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Belépés</button>
                </form>
            </div>
        </div>
    </div>
@endsection
