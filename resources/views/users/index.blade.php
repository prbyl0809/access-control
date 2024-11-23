@extends('layouts.app')

@section('title', 'Dolgozók listája')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Dolgozók listája</h1>
        @can('admin', App\Models\User::class)
            <a href="{{ route('users.create') }}" class="btn btn-primary">Új dolgozó hozzáadása</a>
        @endcan
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Név</th>
                <th>Munkakör</th>
                <th>Telefonszám</th>
                @can('admin', App\Models\User::class)
                    <th>Műveletek</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->position->name ?? 'Nincs munkakör hozzárendelve' }}</td>
                    <td>{{ $user->phone_number }}</td>
                    @can('admin', App\Models\User::class)
                        <td>
                            <a href="{{ route('users.entries', $user->id) }}" class="btn btn-info btn-sm">Belépések
                                megtekintése</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm mr-1">Szerkesztés</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mr-1"
                                    onclick="return confirm('Biztosan törölni szeretnéd ezt a dolgozót?')">Törlés</button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
