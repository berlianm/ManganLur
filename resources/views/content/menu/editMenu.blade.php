@php
    $previous = 'javascript:history.go(-1)';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    $title = 'User Restoran - Edit Menu';
    $jenis_menu = DB::table('jenis_menu')->get();
@endphp

@extends('layouts.main')
@section('content')
    <form action="{{ url('/restoran/menu/update/'.$menu->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-6">
                <img src="{{ asset('images/menu/' . $menu->gambar) }}" alt="" width="75%">
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
                    <label for="menu" class="form-label">Nama Menu</label>
                    <input type="text"
                        class="form-control @error('menu')
                        is-invalid
                    @enderror"
                        id="menu" name="menu" placeholder="Masukan menu menu..." value="{{ $menu->nama_menu }}">
                    @error('menu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">harga</label>
                    <input type="text"
                        class="form-control @error('harga')
                        is-invalid
                    @enderror"
                        id="harga" name="harga" placeholder="Masukan harga menu..." value="{{ $menu->harga }}">
                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis_menu" class="form-label">Jenis Menu</label>
                    <select class="form-select @error('jenis_menu') is-invalid @enderror"
                        aria-label="Default select example" id="jenis_menu" name="jenis_menu">
                        <option value="{{ $menu->jenis_menu_id }}">
                            {{ DB::table('jenis_menu')->where('id', $menu->jenis_menu_id)->value('nama') }}
                        </option>
                        @foreach ($jenis_menu as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan')
                        is-invalid
                    @enderror"
                        id="keterangan" name="keterangan" rows="3">{{ $menu->keterangan }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="hidden" name="restoran_id" id="" value="{{ $idR }}">
                </div>
                <a href="{{ $previous }}" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary float-end">Update</button>
            </div>
        </div>
    </form>
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
