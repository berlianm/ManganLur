@php
    $title = 'Cari Restoran';
    
    $restoran = DB::table('restorans')->get();
@endphp

@extends('layouts.main')
@section('content')
    <div class="container">
        <center>
            <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                    class="fas fa-search"></i> Cari Restoran
            </button>
        </center>
        <div class="row my-5">
            @foreach ($restoran as $item)
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card card-resto" style="width: 300px; height: 200px;">
                                <img class="m-auto" width="280px" height="180px"
                                    src="{{ asset('data_file/' . $item->gambar) }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 my-auto">
                            <div class="card card-detail p-3">
                                <h4>{{ $item->nama_resto }}</h4>
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div class="col-10">
                                        <h6>{{ $item->alamat }}</h6>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div class="col-10">
                                        <h6>{{ $item->jam_buka }} - {{ $item->jam_tutup }}</h6>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a href="{{ $item->lokasi_map }}" target="_blank"><button
                                            class="btn tombol">Location</button></a>
                                    <a href="{{ url('restoran/menu/' . $item->id) }}"><button class="btn btn-primary">See
                                            Resto</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">List Restoran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="example" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Restoran</th>
                                    <th>Jam Buka</th>
                                    <th>Jam Tutup</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restoran as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ url('restoran/menu/' . $item->id) }}">
                                                {{ $item->nama_resto }}
                                            </a>
                                        </td>
                                        <td>{{ $item->jam_buka }}</td>
                                        <td>{{ $item->jam_tutup }}</td>
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
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
