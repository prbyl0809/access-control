@extends('layouts.app')

@section('title', 'Munkakörök listája')

@section('content')
    <div class="container-fluid mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Munkakörök listája</h1>
            @can('admin', App\Models\User::class)
                <a href="{{ route('positions.create') }}" class="btn btn-primary">Új munkakör létrehozása</a>
            @endcan
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped w-100">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 25%;">Munkakör neve</th>
                        <th style="width: 15%;">Dolgozók száma</th>
                        <th style="width: 35%;">Belépési jogosultságok (szobák)</th>
                        @can('auth', App\Models\User::class)
                            <th style="width: 25%;">Műveletek</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->name }}</td>
                            <td>{{ $position->users_count }}</td>
                            <td>
                                @foreach ($position->rooms as $room)
                                    {{ $room->name }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            @can('auth', App\Models\User::class)
                                <td>
                                    <div class="d-flex flex-wrap">
                                        <a href="{{ route('positions.users', $position->id) }}"
                                            class="btn btn-info btn-sm mr-2 mb-2">Dolgozók</a>
                                        @can('admin', App\Models\User::class)
                                            <a href="{{ route('positions.edit', $position->id) }}"
                                                class="btn btn-warning btn-sm mr-2 mb-2">Szerkesztés</a>
                                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-2"
                                                    onclick="return confirm('Biztosan törölni szeretnéd ezt a munkakört?')">Törlés</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
