@php
    $title = 'User Restoran - Menu List';
    $restoran = DB::table('restorans')
        ->where('id', '=', $id)
        ->first();
    
    $jenis_menu = DB::table('jenis_menu')->get();
    
    $review = DB::table('review_resto')
        ->join('users', 'review_resto.user_id', '=', 'users.id')
        ->join('restorans', 'restorans.id', '=', 'review_resto.restoran_id')
        ->where('review_resto.restoran_id', '=', $id)
        ->select('*')
        ->get();
    
    $ratings = DB::table('rating')
        ->join('restorans', 'rating.restoran_id', '=', 'restorans.id')
        ->select(['restorans.id as id', 'restorans.nama_resto as nama', 'restorans.gambar as gambar', DB::raw('AVG(rating.rating) as rating')])
        ->where('rating.restoran_id', '=', $id)
        ->groupBy('rating.restoran_id')
        ->orderByDesc('rating')
        ->limit(1)
        ->get();
    
@endphp

@extends('layouts.main')
@section('content')
    <div class="container-fluid header">
        <div class="container p-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('data_file/' . $restoran->gambar) }}" class="img-thumbnail"
                                alt="{{ $restoran->gambar }}">
                        </div>
                        <div class="col-md-7">
                            <h3 class="card-title">{{ $restoran->nama_resto }}</h3>
                            <div class="row justify-content-center">
                                <div class="col-1">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="col-11">
                                    <h5 class="info">{{ $restoran->alamat }}</h5>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-1">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="col-11">
                                    <h5 class="info">{{ $restoran->jam_buka }} - {{ $restoran->jam_tutup }}</h5>
                                </div>
                            </div>
                        </div>

                        @foreach ($ratings as $item)
                            @php
                                $rating = $item->rating;
                                $rating = number_format($rating, 1);
                            @endphp
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-center">Rating</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <h1 class="text-center"><i class="fas fa-star text-warning"></i> {{ $rating }}</h1>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-2">
                            @auth
                                @if (Auth::user()->role == 'restoran')
                                    <div class="text-center">
                                        <i type="button" class="bi bi-plus-circle text-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" style="font-size: 5rem;"></i>
                                    </div>
                                @endif
                            @endauth



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="btn btn-success float-end mx-2" data-bs-toggle="modal" data-bs-target="#cariMenu"> <i
            class="fas fa-search"></i> Cari Menu</button>
    <button class="btn btn-dark float-end mx-2" data-bs-toggle="modal" data-bs-target="#reviewResto"> <i
            class="fas fa-users"></i> Review Resto</button>
    <button class="btn tombol float-end mx-2" data-bs-toggle="modal" data-bs-target="#komenResto"> <i
            class="fas fa-plus"></i> Tambah Komen</button>
    @auth
        @if (Auth::user()->role == 'user')
            <button class="btn btn-warning float-end mx-2" data-bs-toggle="modal" data-bs-target="#ratingResto"> <i
            class="fas fa-star"></i> Beri Rating</button>
        @endif
    @endauth
    @guest
        <button class="btn btn-warning float-end mx-2" onclick="cekLogin()"> <i
            class="fas fa-star"></i> Beri Rating</button>
    @endguest

    <br><br>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card p-3">

                    @auth
                        @if (Auth::user()->role == 'restoran')
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#jenisMenu"> <i
                                    class="fas fa-plus"></i> Jenis Menu</button>
                        @endif
                    @endauth

                    <br>
                    @foreach ($jenis_menu as $r)
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="float-start">{{ $r->nama }}</h5>
                            </div>
                            <div class="col-md-3 float-end">
                                @auth
                                    @if (Auth::user()->role == 'restoran')
                                        <form action="{{ url('restoran/menu/jenis-menu/hapus/' . $r->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah anda yakin MENGHAPUS Menu ini ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm float-end"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 float-start">

                                @php
                                    $list_menu = DB::table('menus')
                                        ->where('restoran_id','=', $id)
                                        ->where('jenis_menu_id','=',$r->id)
                                        ->where('jenis_menu_id','!=',NULL)
                                        ->get();
                                @endphp
                                <ul>
                                    @foreach ($list_menu as $jMenu)
                                        <li>{{ $jMenu->nama_menu }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    @foreach ($menu as $item)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('images/menu/' . $item->gambar) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama_menu }}</h5>
                                    <p class="card-text">Rp.{{ $item->harga }}</p>

                                    <center>
                                        @auth
                                            @if (Auth::user()->role == 'restoran')
                                                <a href="{{ url('restoran/menu/edit/' . $item->id . '/' . $id) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ url('restoran/menu/hapus/' . $item->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah anda yakin MENGHAPUS data ini ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                        <a href="{{ url('restoran/menu/detail/' . $item->id . '/' . $id) }}"
                                            class="btn btn-info"><i class="fas fa-info-circle"></i> Review
                                        </a>

                                    </center>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="jenisMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('restoran/menu/jenis-menu') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Jenis Menu</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('restoran/menu/upload-menu') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="jenis_menu" class="form-label">Jenis Menu</label>
                            <select class="form-select @error('jenis_menu') is-invalid @enderror"
                                aria-label="Default select example" id="jenis_menu" name="jenis_menu">
                                <option selected>Pilih ----</option>
                                @foreach ($jenis_menu as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="menu" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control @error('menu') is-invalid @enderror" id="menu"
                                name="menu" placeholder="Masukan menu ..." value="{{ old('menu') }}">
                            @error('menu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" name="harga" placeholder="Masukan harga ..."
                                value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                id="gambar" name="gambar" placeholder="Masukan gambar ..."
                                value="{{ old('gambar') }}">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                placeholder="Masukan deskripsi Restoran..." value="{{ old('deskripsi') }}"></textarea>

                        </div>
                        <input type="hidden" name="restoran_id" value="{{ $id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="cariMenu" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $item)
                                <tr>
                                    <td>
                                        <a href="{{ url('restoran/menu/edit/' . $item->id . '/' . $id) }}">
                                            {{ $item->nama_menu }}
                                        </a>
                                    </td>
                                    <td>Rp. {{ $item->harga }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-lg" id="reviewResto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Review Restaurant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="review" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama User</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $item)
                                <tr>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>{{ $item->review }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-lg" id="komenResto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Komen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('review-resto/' . $id) }}" method="post">
                        @csrf
                        <label for="review" class="form-label fw-bold fs-5">Review Restoran</label>
                        <textarea class="form-control" name="review" id="review" placeholder="Enter Your Review..."></textarea>
                        @auth
                            <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                        @endauth
                        <div class="text-end mt-3">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @auth
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endauth
                    @guest
                        <button type="button" class="btn btn-secondary" onclick="cekLogin()">Submit</button>
                    @endguest

                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ratingResto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('restoran/menu/rating/' . $id) }}" method="POST">
                        @csrf
                        <div class="mb-3">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="1">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="2">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="3">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="4">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 4</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="5">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 5</label>
                            </div>
                            @auth
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            @endauth



                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @auth
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endauth
                    @guest
                        <button class="btn btn-secondary" onclick="cekLogin()"> Submit</button>
                    @endguest
                </div>
                </form>
            </div>
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

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#review').DataTable();
        });
    </script>

    <script>
        function cekLogin() {

            swal.fire({
                title: 'Login Dulu',
                text: 'Anda harus login terlebih dahulu untuk memberikan review',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}"
                }
            })
        }
    </script>
@endsection
