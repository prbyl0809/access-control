@extends('layouts.app')

@section('title', 'Belépési történet')

@section('content')
    @can('admin', App\Models\User::class)
        <div class="container mt-5">
            <h1 class="mb-4">{{ $user->name }} belépési története</h1>

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Dátum</th>
                        <th>Szoba</th>
                        <th>Státusz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entries as $entry)
                        <tr>
                            <td>{{ $entry->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $entry->room->name }}</td>
                            <td>
                                <span class="badge {{ $entry->successful ? 'badge-success' : 'badge-danger' }}">
                                    {{ $entry->successful ? 'Sikeres' : 'Sikertelen' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $entries->links() }}
            </div>

            <div class="mt-3">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Vissza a dolgozók listájához</a>
            </div>
        </div>
    @endcan

    @cannot('admin', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod a belépési történet megtekintéséhez!</div>
    @endcannot
@endsection
