@php
    $title = 'User Restoran - Tambah Resto';
@endphp

@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-6">
            <a class="text-decoration-none" href="#">
                <div class="card text-center p-2 mb-3" style="width: 300px; height:300px">
                    <img class="img-fluid mx-auto" width="250px" height="250px" src="{{ asset('images/restaurant.png') }}"
                        alt="">

                </div>
            </a>
        </div>
        <div class="col-6">
            <form action="/upload-resto" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Restoran</label>
                    <input type="text"
                        class="form-control @error('nama')
                        is-invalid
                    @enderror"
                        id="nama" name="nama" placeholder="Masukan Nama Restoran..." value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text"
                        class="form-control @error('alamat')
                        is-invalid
                    @enderror"
                        id="alamat" name="alamat" placeholder="Masukan Alamat Restoran..." value="{{ old('alamat') }}">
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="buka" class="form-label">Jam Buka</label>
                    <input type="time"
                        class="form-control @error('buka')
                        is-invalid
                    @enderror"
                        id="buka" name="buka"  value="{{ old('buka') }}">
                    @error('buka')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tutup" class="form-label">Jam Tutup</label>
                    <input type="time"
                        class="form-control @error('tutup')
                        is-invalid
                    @enderror"
                        id="tutup" name="tutup"  value="{{ old('tutup') }}">
                    @error('tutup')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <a href="/tabel-restoranku" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
@endsection
