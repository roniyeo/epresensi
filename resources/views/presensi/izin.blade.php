@extends('partials.master')
@section('title', 'Data Izin/Sakit')
@section('content')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Izin/Sakit</div>
        <div class="right"></div>
    </div>
    <div class="row" style="margin-top: 70px">
        <div class="col">
            @php
                $messageSuccess = Session::get('success');
                $messageError = Session::get('error');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messageSuccess }}
                </div>
            @else
                <div class="alert alert-error">
                    {{ $messageError }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @foreach ($dataizin as $item)
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ date('d-m-Y', strtotime($item->tanggal)) }}
                                        ({{ $item->status == 's' ? 'Sakit' : 'Izin' }})</b><br>
                                    <small class="text-muted">{{ $item->keterangan }}</small>
                                </div>
                                @if ($item->status_approved == 0)
                                    <span class="badge bg-warning">Waiting</span>
                                @elseif ($item->status_approved == 1)
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($item->status_approved == 2)
                                    <span class="badge bg-danger">Decline</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>

    </div>
    <div class="fab-button bottom-right" style="margin-bottom: 70px">
        <a href="{{ route('presensi.buatizin') }}" class="fab"><ion-icon name="add-outline"></ion-icon></a>
    </div>
@endsection

@push('scriptPresensi')
    <script></script>
@endpush
