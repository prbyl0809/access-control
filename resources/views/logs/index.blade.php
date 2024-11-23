@extends('layouts.app')

@section('title', 'Belépéseim logja')

@section('content')
    <div class="container mt-5">
        <h1>Belépéseim logja</h1>

        @if ($entries->isEmpty())
            <p>Nincs még belépési napló rögzítve.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Dátum</th>
                        <th>Szoba neve</th>
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
        @endif
    </div>
@endsection
