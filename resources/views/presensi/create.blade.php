@extends('partials.master')
@section('title', 'Presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Presensi</div>
        <div class="right"></div>
    </div>
    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;
        }

        #map {
            height: 180px;
        }
    </style>
@endsection
@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" name="lokasi" id="lokasi">
            <div class="webcam-capture"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($cek > 0)
            <button id="takeabsen" class="btn btn-danger btn-block">
                <ion-icon name="camera-outline"></ion-icon> Absen Pulang</button>
            @else
            <button id="takeabsen" class="btn btn-primary btn-block">
                <ion-icon name="camera-outline"></ion-icon> Absen Masuk</button>
            @endif

        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>

    <audio id="sound_masuk">
        <source src="{{ asset('assets/sound/sound_masuk.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="sound_keluar">
        <source src="{{ asset('assets/sound/sound_pulang.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="sound_radius">
        <source src="{{ asset('assets/sound/sound_radius.mp3') }}" type="audio/mpeg">
    </audio>
@endsection
@push('scriptPresensi')
    <script>
        var notifikasi_in = document.getElementById("sound_masuk")
        var notifikasi_out = document.getElementById("sound_keluar")
        var notifikasi_radius = document.getElementById("sound_radius")
        Webcam.set({
            height: 400,
            width: 400,
            image_format: 'jpeg',
            jpeg_quality: 80,
        })

        Webcam.attach('.webcam-capture')

        var lokasi = document.getElementById('lokasi')
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback)
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([1.1247084, 104.0420756], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 100
            }).addTo(map);
        }

        function errorCallback() {

        }

        $("#takeabsen").click(function (e) {
            e.preventDefault()
            Webcam.snap(function (uri) {
                image = uri
            })
            var lokasi = $("#lokasi").val()
            $.ajax({
                type: "POST",
                url: "/presensi/store",
                data: {
                    _token: "{{ csrf_token() }}",
                    image:image,
                    lokasi:lokasi
                },
                cache: false,
                success:function(response){
                    var status = response.split("|")
                    if (status[0] == "success") {
                        if (status[2] == "in") {
                            notifikasi_in.play()
                        }else{
                            notifikasi_out.play()
                        }
                        Swal.fire({
                            icon: 'success',
                            title: status[1],
                            text: 'Anda akan di arahkan dalam 3 Detik',
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                            .then(function () {
                                window.location.href = "/dashboard";
                            });
                    }else{
                        if (status[2] == "radius") {
                            notifikasi_radius.play()
                        }
                        Swal.fire({
                            icon: 'error',
                            title: status[1],
                            text: 'silahkan coba lagi!'
                        });
                    }
                }
            })
        })
    </script>
@endpush
