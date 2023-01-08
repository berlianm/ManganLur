@php
    $title = 'User Restoran - List';
@endphp

@extends('layouts.main')

@section('content')
    <h3>List Restoran</h3>
    <a href="/tambah-resto" class="btn btn-success float-end">Tambah <i class="fas fa-plus"></i></a>
    <br>
    <br>
    <table class="table table-hover bg-light rounded-3" id="example">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Aksi</th>
                <th scope="col">Nama Restoran</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jam Buka</th>
                <th scope="col">Jam Tutup</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="restoran/menu/{{ $item->id }}" class="btn  btn-info"><i
                                    class="fas fa-book"></i></a>
                            <form action="restoran/hapus/{{ $item->id }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apakah Anda Yakin Mengahus Data Ini ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                            <a href="restoran/edit/{{ $item->id }}" class="btn  btn-warning"><i
                                    class="fas fa-edit"></i></a>

                        </div>

                    </td>
                    <td>{{ $item->nama_resto }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->jam_buka }}</td>
                    <td>{{ $item->jam_tutup }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
@endsection
