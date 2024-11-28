@extends('partials.master')
@section('title', 'Dashboard')
@section('content')
    <div id="appCapsule">
        <div class="section" id="user-section">
            <div id="user-detail">
                <div class="avatar">
                    @if (Auth::guard('karyawan')->user()->foto)
                    @php
                        $path = Storage::url('uploads/karyawan' . Auth::guard('karyawan')->user()->foto)
                    @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded" style="height: 60px">
                    @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                    @endif
                </div>
                <div id="user-info">
                    <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
                    <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
                </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="green" style="font-size: 40px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="danger" style="font-size: 40px;">
                                    <ion-icon name="calendar-number"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Cuti</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="{{ route('presensi.history') }}" class="warning" style="font-size: 40px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="{{ route('logout') }}" class="orange" style="font-size: 40px;">
                                    <ion-icon name="location"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Lokasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="row">
                    <div class="col-6">
                        <div class="card gradasigreen">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        @if ($presensi_hariini != null)
                                            @php
                                                $path = Storage::url('/uploads/absensi/' . $presensi_hariini->foto_in);
                                            @endphp
                                            <img src="{{ url($path) }}" alt="" class="imaged w64">
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Masuk</h4>
                                        <span>{{ $presensi_hariini != null ? $presensi_hariini->jam_in : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card gradasired">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        @if ($presensi_hariini != null && $presensi_hariini->jam_out != null)
                                            @php
                                                $path = Storage::url('/uploads/absensi/' . $presensi_hariini->foto_out);
                                            @endphp
                                            <img src="{{ url($path) }}" alt="" class="imaged w64">
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Pulang</h4>
                                        <span>{{ $presensi_hariini != null && $presensi_hariini->jam_out != null ? $presensi_hariini->jam_out : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rekappresence">
                <h3 style="font-size: 1rem" class="text-center">Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun
                    {{ $tahunini }}</h3>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge bg-danger"
                                    style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index:999">{{ $rekappresensi->jmlhadir }}</span>
                                <ion-icon name="accessibility-outline" style="font-size: 1.6rem"
                                    class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 1rem; font-weight: 500">Hadir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge bg-danger"
                                    style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index:999">0</span>
                                <ion-icon name="newspaper-outline" style="font-size: 1.6rem"
                                    class="text-success mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 1rem; font-weight: 500">izin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge bg-danger"
                                    style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index:999">0</span>
                                <ion-icon name="medkit-outline" style="font-size: 1.6rem"
                                    class="text-warning mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 1rem; font-weight: 500">Sakit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge bg-danger"
                                    style="position: absolute; top:3px; right: 10px; font-size: 0.6rem; z-index:999">{{ $rekappresensi->jlmterlambat }}</span>
                                <ion-icon name="alarm-outline" style="font-size: 1.6rem"
                                    class="text-danger mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 1rem; font-weight: 500">Telat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                Bulan Ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Leaderboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($historibulanini as $b)
                                {{-- @php
                                $path = Storage::url('uploads/absensi/'.$b->foto_in);
                            @endphp --}}
                                <li>
                                    <div class="item">
                                        <div class="icon-box bg-primary">
                                            <ion-icon name="finger-print-outline"></ion-icon>
                                        </div>
                                        <div class="in">
                                            <div>{{ date('d-m-Y', strtotime($b->tgl_presensi)) }}</div>
                                            <span class="badge badge-success">{{ $b->jam_in }}</span>
                                            <span
                                                class="badge badge-danger">{{ $b->jam_out != null ? $b->jam_out : 'Belum Absen' }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($leaderboard as $d)
                                <li>
                                    <div class="item">
                                        <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                        <div class="in">
                                            <div>
                                                <b>{{ $d->nama_lengkap }}</b><br>
                                                <small class="text-muted">{{ $d->jabatan }}</small>
                                            </div>
                                            <span class="badge {{ $d->jam_in < '07:00' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $d->jam_in }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->
@endsection
