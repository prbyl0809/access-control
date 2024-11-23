@extends('layouts.app')

@section('title', 'Szobák listája')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Szobák listája</h1>
            @can('admin', App\Models\User::class)
                <a href="{{ route('rooms.create') }}" class="btn btn-primary">Új szoba létrehozása</a>
            @endcan
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Szoba neve</th>
                    <th>Jogosult munkakörök</th>
                    @can('admin', App\Models\User::class)
                        <th>Műveletek</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>
                            @foreach ($room->positions as $position)
                                {{ $position->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        @can('admin', App\Models\User::class)
                            <td>
                                <a href="{{ route('rooms.entries', $room->id) }}" class="btn btn-info btn-sm mr-1">Belépések
                                    megtekintése</a>
                                <a href="{{ route('rooms.edit', $room->id) }}"
                                    class="btn btn-warning btn-sm mr-1">Szerkesztés</a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Biztosan törölni szeretnéd ezt a szobát?')">Törlés</button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
