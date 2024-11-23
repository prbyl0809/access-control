@extends('layouts.app')

@section('title', 'Munkakör dolgozói')

@section('content')
    @can('auth', App\Models\User::class)

        <div class="container mt-5">
            <h1 class="mb-4">{{ $position->name }} dolgozói</h1>

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Név</th>
                        <th>Telefonszám</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                <a href="{{ route('positions.index') }}" class="btn btn-secondary">Vissza a munkakörök listájához</a>
            </div>
        </div>
    @endcan

    @cannot('auth', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod a pozícióhoz tartozó dolgozók megtekintéséhez!</div>
    @endcannot
@endsection
