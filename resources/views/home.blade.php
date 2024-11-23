@extends('layouts.app')

@section('title', 'Főoldal')

@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Üdvözöllek a jogosultságkezelő rendszerben!</h1>
            <p class="lead">Ez az alkalmazás lehetővé teszi a dolgozók beléptetésének kezelését különböző szobákhoz, ahol
                belépési jogosultságokat állíthatsz be pozíciók szerint.</p>
            <hr class="my-4">
            <h2>Statisztikák</h2>
            <ul class="list-group">
                <li class="list-group-item">Létrehozott szobák száma: <strong>{{ $roomCount }}</strong></li>
                <li class="list-group-item">Kezelt dolgozók száma: <strong>{{ $userCount }}</strong></li>
            </ul>
        </div>
    </div>
@endsection
