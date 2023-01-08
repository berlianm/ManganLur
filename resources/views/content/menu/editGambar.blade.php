@php
    $previous = 'javascript:history.go(-1)';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    $title = 'Edit - Gambar';
@endphp
@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col">
            <center>
                <img src="{{ asset('images/menu/' . $gambar->gambar) }}" alt="" width="50%">
                <br>
                <div class="mb-3">
                    <form action="{{ url('update/gambar/' . $gambar->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file"
                            class="form-control @error('gambar')
                    is-invalid
                @enderror w-50 mt-2"
                            id="gambar" name="gambar">
                        @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="hidden" name="menu_id" value="{{ $idM }}">
                        <a href="{{ $previous }}" class="btn btn-light mt-2">Kembali</a>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </center>
        </div>
    </div>
@endsection
@section('script')
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
    @if (session()->has('status'))
        <script>
            toastr.success(`{{ session('message') }}`);
        </script>
    @endif
@endsection
