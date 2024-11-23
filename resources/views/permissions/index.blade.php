@extends('layouts.app')

@section('title', 'Jogosultságaim')

@section('content')
    <div class="container mt-5">
        <h1>Jogosultságaim</h1>
        <p><strong>Munkakör:</strong> {{ $user->position->name ?? 'Nincs munkakör hozzárendelve' }}</p>

        <h2>Belépési jogosultságok</h2>

        @if($rooms->isEmpty())
            <p>Nincs jogosultság szobákhoz.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Szoba</th>
                        <th>Kép</th>
                        <th>Leírás</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->name }}</td>
                            <td>
                                @if($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" style="width: 100px; height: auto;">
                                @else
                                    Nincs kép
                                @endif
                            </td>
                            <td>{{ $room->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
