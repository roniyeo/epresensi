@extends('partials.master')
@section('title', 'History')
@section('content')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Histori Presensi</div>
        <div class="right"></div>
    </div>

    <div class="row" style="margin-top: 70px">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">Bulan</option>
                        @for ($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>{{ $namaBulan[$i] }}</option>
                        @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">Tahun</option>
                            @php
                                $tahunmulai = 2022;
                                $tahunskrg = date('Y');
                            @endphp
                            @for ($tahun=$tahunmulai; $tahun<=$tahunskrg; $tahun++)
                                <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" id="getdata">
                            <ion-icon name="search-outline"></ion-icon> Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col" id="showhistory"></div>
    </div>
@endsection

@push('scriptPresensi')
<script>
    $(function () {
        $("#getdata").click(function (e) {
            e.preventDefault()
            var bulan = $("#bulan").val()
            var tahun = $("#tahun").val()
            // console.log(bulan+'-'+tahun);
            $.ajax({
                type: "POST",
                url: "/gethistory",
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan:bulan,
                    tahun:tahun,
                },
                cache: false,
                success: function (response) {
                    $("#showhistory").html(response)

                }
            })
        })
    })
</script>
@endpush
