@extends('partials.master')
@section('title', 'Data Izin/Sakit')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal{
        max-height: 430px !important;
    }

    .datepicker-date-display{
        background-color: #0f3a7e !important;
    }
</style>
@section('content')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('presensi.izin') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Izin</div>
        <div class="right"></div>
    </div>

    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="{{ route('presensi.storeizin') }}" method="post" id="formizin">
                @csrf
                <div class="container">
                    <div class="form-group">
                        <input type="text" name="tanggal" id="tanggal" class="form-control datepicker"
                            placeholder="Tanggal">
                    </div>
                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">Izin / Sakit</option>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary w-100" id="kirim">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scriptPresensi')
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd"
            });

            $("#formizin").submit(function() {
                var tanggal = $("#tanggal").val()
                var status = $("#status").val()
                var keterangan = $("#keterangan").val()
                if (tanggal == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Tanggal harus di isi'
                    });
                    return false;
                }else if (status == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Status harus di isi'
                    });
                    return false;
                }else if (keterangan == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Keterangan harus di isi'
                    });
                    return false;
                }
            })
        });
    </script>
@endpush
