@if ($history->isEmpty())
    <div class="alert alert-warning">Data Belum Ada</div>
@endif
@foreach ($history as $item)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/absensi/' . $item->foto_in);
                @endphp
                <img src="{{ url($path) }}" alt="" class="image">
                <div class="in">
                    <div>
                        <b>{{ date('d-m-Y', strtotime($item->tgl_presensi)) }}</b>
                        {{-- <small class="text-muted">{{ $item->jabatan }}</small> --}}
                    </div>
                    <span
                        class="badge {{ $item->jam_in < '07.00' ? 'bg-success' : 'bg-danger' }}">{{ $item->jam_in }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach
