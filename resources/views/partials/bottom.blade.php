<div class="appBottomMenu">
    <a href="{{ route('dashboard') }}" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="{{ route('presensi.history') }}" class="item {{ request()->is('presensi/history') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated" aria-label="document-text-outline"></ion-icon>
            <strong>History</strong>
        </div>
    </a>
    <a href="{{ route('presensi.create') }}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="{{ route('presensi.izin') }}" class="item">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="calendar-outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>
    <a href="{{ route('presensi.edit-profile') }}" class="item {{ request()->is('presensi/edit-profile') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
