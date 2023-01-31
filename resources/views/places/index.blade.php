@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-13">
            <div class="card bg-light">
                <x:notify-messages />
                <div class="card-header">Data Rumah Sakit Kabupaten Banyumas</div>
                <div class="card-body">
                    <a href="{{ route('places.create') }}" class="btn btn-primary btn-sm float-right">Tambah RS</a><br><br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status Akreditasi</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Website</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                    @forelse ($place as $place)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$place->nama}}</td>
                        <td>{{$place->status_akreditasi}}</td>
                        <td>{{$place->alamat}}</td>
                        <td>{{$place->notelp}}</td>
                        <td>{{$place->website}}</td>
                        <td>{{$place->longitude}}</td>
                        <td>{{$place->latitude}}</td>
                        <td><form action="{{ route('places.edit',['place'=>$place->id]) }}" class="font-semibold"><button type="submit" class="btn btn-success btn-sm float-right">Edit</button></form><br><br><form action="{{ route('place.destroy',['place'=>$place->id]) }}" method="POST" class="font-semibold">
                      @method('DELETE') @csrf 
                    <button type="submit" class="btn btn-danger btn-sm float-right">Hapus</button></form></td>
                    </tr>
                    @empty
                    <td colspan="6" class="text-center">Tidak ada data...</td>
                    @endforelse
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
