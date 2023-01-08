@php
    $title = 'User Restoran - Edit Restoran';
@endphp

@extends('layouts.main')
@section('content')
    <form action="/update/resto/{{ $data->id }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <h3>Edit Restoran</h3>
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-6">
                <img src="{{ asset('data_file/'.$data->gambar ) }}" alt="" width="75%">
                <br>
                <div class="mb-3">
                    <label for="gambar" class="form-label mt-2 "> Ganti gambar </label>
                    <input type="file"
                        class="form-control @error('gambar')
                        is-invalid
                    @enderror w-75"
                        id="gambar" name="gambar">
                    @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Restoran</label>
                    <input type="text"
                        class="form-control @error('nama')
                        is-invalid
                    @enderror"
                        id="nama" name="nama" placeholder="Masukan Nama Restoran..."
                        value="{{ $data->nama_resto }}">
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
                        id="alamat" name="alamat" placeholder="Masukan Alamat Restoran..." value="{{ $data->alamat }}">
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
                        id="buka" name="buka" value="{{ $data->jam_buka }}">
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
                        id="tutup" name="tutup" value="{{ $data->jam_tutup }}">
                    @error('tutup')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="map" class="form-label">URL Google Map</label>
                    <input type="text"
                        class="form-control @error('map')
                        is-invalid
                    @enderror"
                        id="map" name="map" value="{{ $data->lokasi_map }}">
                    @error('map')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan')
                        is-invalid
                    @enderror"
                        id="keterangan" name="keterangan" rows="3">{{ $data->keterangan }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <a href="/tabel-restoranku" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary float-end">Update</button>
            </div>
        </div>
    </form>
    <br><br>
@endsection

@section('script')
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
@endsection
