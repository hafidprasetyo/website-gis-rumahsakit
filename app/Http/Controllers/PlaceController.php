<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
   
    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:3',
            'status_akreditasi'   => 'required|min:10',
            'alamat' => 'required|min:10',
            'notelp'  => 'required',
            'website'  => 'required',
            'longitude'  => 'required',
            'latitude'  => 'required'
        ]);
        Place::create([
            'nama' => $request->nama,
            'status_akreditasi'  => $request->status_akreditasi,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'website' => $request->website,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);
        notify()->success('Data Rumah Sakit Berhasil Dibuat');
        return redirect()->route('places.index');
    }

    public function index(Place $place)
    {
        $place = Place::all();
        return view('places.index',['place' => $place]);
    }

    public function show(Place $place)
    {
        return view('places.detail', [
            'place' => $place,
        ]);
    }

    public function edit(Place $place)
    {
        return view('places.edit', [
            'place' => $place,
        ]);
    }

    public function update(Request $request, Place $place)
    {
        $this->validate($request, [
            'nama' => 'required|min:3',
            'status_akreditasi'   => 'required|min:10',
            'alamat' => 'required|min:10',
            'notelp'  => 'required',
            'website'  => 'required',
            'longitude'  => 'required',
            'latitude'  => 'required'
        ]);

        $place->update([
            'nama' => $request->nama,
            'status_akreditasi'  => $request->status_akreditasi,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'website' => $request->website,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        notify()->info('Data Rumah Sakit Telah Di Update');
        return redirect()->route('places.index');
    }

    public function destroy(Request $request, Place $place)
    {
        $place->delete();
        notify()->warning('Data Rumah Sakit Telah Di Hapus');
        return redirect()->route('places.index');
    }

    public function sampleMap()
    {
        return view('sample');
    }
}