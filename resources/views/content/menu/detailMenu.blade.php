@php
    $previous = 'javascript:history.go(-1)';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    $title = 'User Restoran - Edit Menu';
    $jenis_menu = DB::table('jenis_menu')->get();
    $review = DB::table('review_menu')
        ->join('users', 'review_menu.user_id', '=', 'users.id')
        ->join('menus', 'menus.id', '=', 'review_menu.menu_id')
        ->where('review_menu.menu_id', '=', $menu->id)
        ->select('*')
        ->get();
    
    $gambar_menu = DB::table('gambar_menu')
        ->where('menu_id', '=', $menu->id)
        ->get();
@endphp

@extends('layouts.main')
@section('content')
    <div class="container-fluid header">
        <div class="container p-3">
            <div class="row">
                @foreach ($gambar_menu as $item)
                    <div class="col">
                        <img src="{{ asset('images/menu/' . $item->gambar) }}" class="img-thumbnail" alt="">
                        @auth
                            @if (Auth::user()->role == 'restoran')
                                <a href="{{ url('edit-gambar/menu/' . $item->id . '/' . $menu->id) }}" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ url('hapus/gambar/' . $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah anda yakin MENGHAPUS data ini ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @endforeach
                <div class="col">
                    <img src="{{ asset('images/menu/' . $menu->gambar) }}" class="img-thumbnail" alt="">
                </div>

                <div class="col">
                    @auth
                        @if (Auth::user()->role == 'restoran')
                            <div class="text-center mb-3">
                                <i type="button" class="bi bi-plus-circle text-white" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" style="font-size: 6rem;"></i>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h4>{{ $menu->nama_menu }}</h4>
                    <p>
                        {{ $menu->keterangan }}
                    </p>
                </div>
                <div class="card p-3">
                    <table>
                        <thead>
                            <tr>
                                <th class="fw-bold">User</th>
                                <th class="fw-bold">Komen</th>
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
            </div>
            <div class="col-md-6">
                <div class="card p-3 ">
                    <form action="{{ url('review-menu/' . $menu->id) }}" method="post">
                        @csrf
                        <label for="review" class="form-label fw-bold fs-5">Review Food</label>
                        <textarea class="form-control" name="review" id="review" placeholder="Enter Your Review..."></textarea>
                        @auth
                            <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                        @endauth
                        <div class="text-end mt-3">
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('tambah-gambar/' . $menu->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input class="form-control" type="file" name="gambar" id="image">
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
