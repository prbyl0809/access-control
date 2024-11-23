@extends('layouts.app')

@section('title', 'Új szoba létrehozása')

@section('content')
    @can('admin', App\Models\User::class)
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Új szoba létrehozása</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Szoba neve:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Leírás:</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>

                        <div class="form-group">
                            <label for="image">Kép:</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            <div id="cover_preview" class="col-12 mt-3 d-none">
                                <p>Cover preview:</p>
                                <img id="cover_preview_image" src="#" alt="Cover preview" width="300px" class="img-thumbnail">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="positions">Jogosult munkakörök:</label>
                            <select name="positions[]" id="positions" class="form-control" multiple>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Tartsd lenyomva a Ctrl vagy Command gombot több munkakör
                                kiválasztásához.</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Létrehozás</button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary btn-block mt-2">Vissza a szobák
                            listájához</a>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @cannot('admin', App\Models\User::class)
        <div class="alert alert-danger">Nincs jogod új szoba létrehozásához!</div>
    @endcannot

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const coverImageInput = document.getElementById('image');
            const coverPreviewContainer = document.getElementById('cover_preview');
            const coverPreviewImage = document.getElementById('cover_preview_image');

            coverImageInput.addEventListener('change', function (event) {
                const file = this.files[0];
                if (file) {
                    coverPreviewContainer.classList.remove('d-none');
                    coverPreviewImage.src = URL.createObjectURL(file);
                } else {
                    coverPreviewContainer.classList.add('d-none');
                }
            });
        });
    </script>
@endsection

