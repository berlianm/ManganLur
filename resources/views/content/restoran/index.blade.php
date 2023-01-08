@php
    $title = 'Halaman User Restoran';
    $restoran = DB::table('restorans')
        ->where('user_id', '=', Auth::user()->id)
        ->first();
@endphp

@extends('layouts.main')

@section('content')
    <div class="row justify-content-between ">
        <div class="col-md-6">
            <a class="text-decoration-none" href="/tabel-restoranku">
                <div class="card text-center p-2 mb-3" >
                    <img class="img-fluid mx-auto" width="70%" height="70%" src="{{ asset('images/restaurant.png') }}"
                        alt="">
                    <h3 class="text-black px-3">Setting</h3>
                </div>
            </a>


        </div>

        @if ($restoran == null)
            <div class="col-md-6">
                <a class="text-decoration-none" href="/tambah-resto">
                    <div class="card text-center p-2 mb-3" >
                        <i class="bi bi-plus" style="font-size: 15rem;"></i>
                        
                        <h3 class="text-black px-3">Tambah Restoran</h3>
                    </div>
                </a>
            </div>
        @else
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-black">Restoranku</h5>
                <div class="row">
                    @if ($restoran->gambar == NULL)
                        <img src="{{ asset('images/restaurant.png') }}" class="rounded mb-1" width="300px" height="200px"
                            alt="">
                        @else
                        <img src="{{ asset('data_file/'.$restoran->gambar) }}" class="rounded mb-1" width="300px" height="200px"
                        alt="">
                    @endif
                    <h4>{{ $restoran->nama_resto }}</h4>
                    <div class="row justify-content-start">
                        <div class="col-1">
                            <i class="bi bi-geo-alt-fill" style="font-size: 25px;"></i>
                        </div>
                        <div class="col-10 info">
                            <h6>{{ $restoran->alamat }}</h6>
                        </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-1">
                            <i class="bi bi-clock" style="font-size: 25px;"></i>
                        </div>
                        <div class="col-10 info">
                            <h6>{{ $restoran->jam_buka }} - {{ $restoran->jam_tutup }}</h6>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ $restoran->lokasi_map }}"><button class="btn tombol">Location</button></a>
                        <a href="{{ url('restoran/menu/' . $restoran->id) }}"><button class="btn tombol">See Resto</button></a>
                    </div>
                </div>
            </div>
        </div>
            
        @endif
    </div>
@endsection

@section('script')
    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: 'Selamat Datang, {{ Auth::user()->name }}',
                text: `Anda {{ session('success') }}`,
                icon: 'success',
                confirmButtonText: 'Oke'
            })
        </script>
    @endif
@endsection
