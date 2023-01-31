@extends('layouts.home')

@section('content')
<div class="container">

<div class="card bg-light">
<figure class="text-center mt-5">
        <blockquote class="blockquote">
            <h3>WebGISH</h3>
            <p>WebGISH adalah website GIS Rumah Sakit atau pemetaan digital untuk mendistribusikan, mempublikasikan, mengintegrasikan, mengkomunikasikan dan menyediakan informasi dalam bentuk teks dan peta digital</p>
        </blockquote>
        </figure>
</div>

<p class="fw-bold fs-3 text-center text-secondary mt-4">Daftar Rumah Sakit</p>
    <div class="logo-slider">
    <div class="item"><a href="#"><img src="{{ asset('image/RSMargono.png')}}"  width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSIslampwtt.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSSiaga.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSSanta.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSUnsud.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSAnanda.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSWiradadi.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSBanyumas.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSKeluarga.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSSinar.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSHermina.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSOP.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSMedika.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSAmanah.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSBunda.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSArif.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSMitra.png')}}" width="100px">
    </a></div>
    <div class="item"><a href="#"><img src="{{ asset('image/RSHidayah.png')}}" width="100px">
    </a></div>
    </div>



<br><br>
<div class="col-lg-15"> 
            <div class="card bg-light">
            <div id="mapid">
                <div class="card">
                    <div class="card-body"></div>
                    <x:notify-messages />
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection

@section('styles')
<!-- Leaflet CSS -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
      <link rel="stylesheet" href="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.css">
    <style>
      #mapid { min-height: 500px; }
    </style>
@endsection

@push('scripts')
 <!-- Leaflet JavaScript -->
      <!-- Make sure you put this AFTER Leaflet's CSS -->
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </scrip>
      <script src="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.js"></script>
<script>


var map = L.map('mapid').setView([{{ config('leafletsetup.map_center_latitude') }},
    {{ config('leafletsetup.map_center_longitude') }}],
    {{ config('leafletsetup.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    axios.get('{{ route('api.places.index') }}')
    .then(function (response) {
        //console.log(response.data);
        L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
            return ('<div class="my-2"><strong>Nama</strong> :<br>'+layer.feature.properties.nama+'</div> <div class="my-2"><strong>Status Akreditasi</strong> :<br>'+layer.feature.properties.status_akreditasi+'</div><div class="my-2"><strong>Alamat</strong> :<br>'+layer.feature.properties.alamat+'</div><div class="my-2"><strong>No Telepon</strong> :<br>'+layer.feature.properties.notelp+'</div><div class="my-2"><strong>Website</strong> :<br>'+layer.feature.properties.website+'</div>');
        }).addTo(map);
        console.log(response.data);
    })
    .catch(function (error) {
        console.log(error);
    });

//SIMPLE SEARCH LOCATION
var data = [
        <?php
        foreach ($places as $key => $value) {
        ?>
            {"loc":[<?= $value->latitude ?>,<?= $value->longitude ?>], "title": '<?= $value->nama ?>'},
        <?php } ?>
    ];

	var markersLayer = new L.LayerGroup();	//layer contain searched elements

	map.addLayer(markersLayer);
    console.log(data);
	var controlSearch = new L.Control.Search({
		position:'topleft',
		layer: markersLayer,
		initial: false,
		zoom: 17,
		markerLocation: true
	})
	map.addControl( controlSearch );
	////////////populate map with markers from sample data
	for(i in data) {
		var title = data[i].title,	//value searched
			loc = data[i].loc,		//position found
			marker = new L.Marker(new L.latLng(loc), {title: title} );//se property searched
		marker.bindPopup('title: '+ title );
		markersLayer.addLayer(marker);
	}
    // SIMPLE SEARCH LOCATION
    $('#textsearch').on('keyup', function(e) {

    controlSearch.searchText( e.target.value );
    });

</script>
@endpush

