@extends('layouts.app')

@section('title', 'Belépési történet')

@section('content')
    @can('admin', App\Models\User::class)
        <div class="container mt-5">
            <h1 class="mb-4">Szoba belépési naplója</h1>

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Dátum</th>
                        <th>Dolgozó neve</th>
                        <th>Telefonszám</th>
                        <th>Munkakör</th>
                        <th>Státusz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entries as $entry)
                        <tr>
                            <td>{{ $entry->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $entry->user->name }}</td>
                            <td>{{ $entry->user->phone_number }}</td>
                            <td>{{ $entry->user->position->name ?? 'N/A' }}</td>
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
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Vissza a szobák listájához</a>
            </div>
        </div>
    @endcan

    @cannot('admin', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod a szoba belépési történetének megtekintéséhez!</div>
    @endcannot
@endsection
