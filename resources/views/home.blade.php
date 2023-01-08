@php
    $title = 'Home';
    $restorans = DB::table('rating')
        ->join('restorans', 'rating.restoran_id', '=', 'restorans.id')
        ->select(['restorans.*', DB::raw('AVG(rating.rating) as rating')])
        ->groupBy('rating.restoran_id')
        ->orderByDesc('rating')
        ->limit(1)
        ->get();
@endphp

@extends('layouts.main')

@section('hero')
    <img src="{{ asset('images/logoHead.png') }}" alt="Logo">
@endsection

@section('contact')
    <p>
        <a class="btn tombol fs-4 mx-3" data-bs-toggle="collapse" href="#contact" role="button" aria-expanded="false"
            aria-controls="contact">Contact
        </a>
        <button class="btn tombol fs-4 mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#about"
            aria-expanded="false" aria-controls="about">About Us
        </button>


    </p>
    <div class="row">
        <div class="col">
            <div class="collapse multi-collapse" id="contact">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a
                                href="https://api.whatsapp.com/send?phone=6282324802523&text=Hallo%20ManganLur!!!%0AAplikasi%20Review%20Restoran%20Terbaik."><button
                                    class="btn tombol btn-wa w-100 mx-3 fs-5"><i class="bi bi-whatsapp"></i>
                                    WhatsApp</button></a>
                        </div>
                        <div class="col-md-6">
                            <a href="https://www.instagram.com/Mangan.Lur.project/"><button
                                    class="btn tombol btn-ig w-100 mx-3 fs-5"><i class="bi bi-instagram"></i>
                                    Instagram</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="collapse multi-collapse" id="about">
                <div class="card card-body">
                    <h4 class="text-center">About Us</h4>
                    <p>Dalam membuat bisnis restoran kita harus mengetahui kekurangan dari
                        restoran yang kita miliki. Bagi pecinta kuliner harus tahu mana restoran yang bagus,
                        menarik dan tentunya cocok dengan selera kita. Oleh karena itu kami membuat web aplikasi
                        untuk menilai kekurangan dan kelebihan dari restoran. Untuk membantu restoran agar lebih baik
                        dan lebih menarik pelanggan baru dari review pelanggan yang pernah berkunjung ke restoran tersebut.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- <div class="row my-5">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Search" style="height: 50px ;">
            </div>
        </div>
    </div> --}}
    <div class="row justify-content-between my-5 ">
        <div class="col-md-4">
            <a class="text-decoration-none" href="{{ url('cari-resto') }}">
                <div class="card text-center p-2 mb-3" style="width: 250px; height:250px">
                    <img class="img-fluid mx-auto" width="200px" height="200px" src="{{ asset('images/restaurant.png') }}"
                        alt="">
                    <h3 class="text-black px-3" class=>Cari Resto</h3>
                </div>
            </a>
            <a class="text-decoration-none" href="{{ url('rating-resto') }}">
                <div class="card text-center p-2 mt-5" style="width: 250px; height:250px; margin-left: 215px">
                    <img class="img-fluid mx-auto" width="200px" height="200px" src="{{ asset('images/rating.png') }}"
                        alt="">
                    <h3 class="text-black px-3" class=>Review</h3>
                </div>
            </a>

        </div>
        <div class="col-md-4 ">
            <a class="text-decoration-none" href="{{ url('cari-makan') }}">
                <div class="card text-center p-2 mb-3" style="width: 250px; height:250px">
                    <img class="img-fluid mx-auto" width="200px" height="200px" src="{{ asset('images/fast-food.png') }}"
                        alt="">
                    <h3 class="text-black px-3" class=>Cari Makanan</h3>
                </div>
            </a>

        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h5 class="text-black">Resto Terpopuler</h5>
                @foreach ($restorans as $item)
                    <div class="row">
                        <img src="{{ asset('data_file/' . $item->gambar) }}" class="rounded mb-1" width="300px"
                            height="200px" alt="">
                        <h4>{{ $item->nama_resto }}</h4>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="col-10 info">
                                <h6>{{ $item->alamat }}</h6>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="col-10 info">
                                <h6>{{ $item->jam_buka }} - {{ $item->jam_tutup }}</h6>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <div class="col-10 info">
                                @php
                                    $rating = $item->rating;
                                    $rating = number_format($rating, 1);
                                @endphp
                                <h6>{{ $rating }}</h6>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ $item->lokasi_map }}" target="_blank"><button
                                    class="btn tombol">Location</button></a>
                            <a href="{{ url('restoran/menu/' . $item->id) }}"><button class="btn tombol">See
                                    Resto</button></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
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
    @if (session()->has('logout'))
        <script>
            Swal.fire({
                title: 'Sukses!!',
                text: `{{ session('logout') }}`,
                icon: 'success',
                confirmButtonText: 'Oke'
            })
        </script>
    @endif
@endsection
