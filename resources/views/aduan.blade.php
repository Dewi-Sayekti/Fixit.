<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FIXIT - Aduan</title>

<style>
@font-face {
    font-family: 'Brigends';
    src: url('/fonts/BrigendsExpanded.otf') format('opentype');
}
@font-face {
    font-family: 'Graphite';
    src: url('/fonts/GraphiteDEMO.otf') format('opentype');
}

.nav-item {
    color: white;
    opacity: 0.6;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none; /* ⬅️ PENTING */
}

.nav-item.active {
    opacity: 1;
    border-bottom: 2px solid white;
    padding-bottom: 4px;
}


body {
    margin: 0;
    background: #102B57;
    font-family: 'Graphite', sans-serif;
    color: white;
}

/* ================= HEADER ================= */
.header {
    padding: 20px 30px;
    font-size: 32px;
    font-family: 'Brigends';
    letter-spacing: 2px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.top-right {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 6px;
}

.username-text {
    font-size: 15px;
    font-family: 'Graphite', sans-serif;
}

.role-badge {
    background: white;
    padding: 3px 10px;
    font-size: 12px;
    border-radius: 6px;
    font-weight: bold;
    color: #102B57;
    font-family: 'Graphite', sans-serif;
}

/* ================= WRAPPER ================= */
.wrapper {
    width: 88%;
    background: white;
    padding: 26px;
    border-radius: 26px;
    margin: 20px auto 120px;
    color: #102B57;
}

.judul {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* ================= TILE ================= */
.tile {
    display: flex;
    gap: 16px;
    padding: 16px;
    border: 2px solid #d0dae9;
    border-radius: 16px;
    margin-bottom: 16px;
    align-items: center; /* Tambahan agar konten sejajar */
}

.tile img {
    width: 90px;
    height: 90px;
    border-radius: 10px;
    object-fit: cover;
}

.tile-text {
    flex: 1;
    font-size: 14px;
}

.status-diadu { color: #d68b00; }
.status-diproses { color: #007c3a; }
.status-selesai { color: #007c3a; }

.timestamp {
    display: inline-block;
    margin-top: 8px;
    font-size: 13px;
    color: #102B57;
    cursor: default;
}

.btn-outline {
    border: 2px solid #102B57;
    background: transparent;
    color: #102B57;
    padding: 8px 22px;
    border-radius: 30px;
    cursor: pointer;
    font-family: 'Graphite';
    font-size: 12px;
}

.btn-create {
    margin-left: auto;
    display: block;
    margin-top: 20px;
}

/* ================= POPUP ================= */
.overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 99;
}

.popup {
    position: relative;
    background: white;
    width: 80%;
    max-width: 420px;
    border-radius: 26px;
    padding: 26px;
    color: #102B57;
}

.popup-close {
    position: absolute;
    top: 14px;
    right: 18px;
    font-size: 22px;
    cursor: pointer;
    color: #102B57;
    font-weight: bold;
}

.upload-box {
    border: 2px dashed #c9d3e6;
    border-radius: 20px;
    height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

textarea, select {
    width: 100%;
    margin-top: 10px;
    border-radius: 10px;
    padding: 8px;
    border: 2px solid #c9d3e6;
}

/* ================= NAV ================= */
.nav-bottom {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: #102B57;
    padding: 16px 0;
    display: flex;
    justify-content: space-around;
    border-top: 1px solid rgba(255,255,255,0.25);
}

.nav-item {
    color: white;
    opacity: 0.6;
    font-size: 16px;
    cursor: pointer;
}

.nav-item.active {
    opacity: 1;
    border-bottom: 2px solid white;
    padding-bottom: 4px;
}

/* ================= FILTER DROPDOWN ================= */
.filter-dropdown-container {
    position: relative;
    display: inline-block;
}

.filter-btn {
    background: #f5f5f5;
    border: 2px solid #d0dae9;
    color: #102B57;
    padding: 10px 16px;
    border-radius: 20px;
    cursor: pointer;
    font-family: 'Graphite', sans-serif;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    background: #e8e8e8;
    border-color: #102B57;
}

.filter-btn.active {
    background: #102B57;
    color: white;
    border-color: #102B57;
}

.filter-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: #2a3f5f;
    border-radius: 12px;
    min-width: 180px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    margin-top: 8px;
    display: none;
    z-index: 100;
    overflow: hidden;
}

.filter-menu.show {
    display: block;
}

.filter-option {
    display: block;
    color: #ccc;
    padding: 12px 18px;
    text-decoration: none;
    font-family: 'Graphite', sans-serif;
    font-size: 13px;
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
}

.filter-option:hover {
    background: #3a4f6f;
    color: white;
}

.filter-option.active {
    background: #102B57;
    color: white;
    border-left-color: white;
}
</style>
</head>

<body>

{{-- HEADER --}}
<div class="header">
    <div>FIXIT.</div>
    <div class="top-right">
        <div class="username-text">{{ Auth::user()->username }}</div>
        <div class="role-badge">{{ Auth::user()->role }}</div>
    </div>
</div>

{{-- CONTENT --}}
<div class="wrapper">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div class="judul">aduan</div>
        <div class="filter-dropdown-container">
            <button class="filter-btn" id="filterBtn">Filter Status ▼</button>
            <div class="filter-menu" id="filterMenu">
                <a href="{{ route('aduan.index') }}" class="filter-option {{ !$statusFilter ? 'active' : '' }}">• semua</a>
                <a href="{{ route('aduan.index', ['status' => 'diadukan']) }}" class="filter-option {{ $statusFilter === 'diadukan' ? 'active' : '' }}">• diadukan</a>
                <a href="{{ route('aduan.index', ['status' => 'diproses']) }}" class="filter-option {{ $statusFilter === 'diproses' ? 'active' : '' }}">• diproses</a>
                <a href="{{ route('aduan.index', ['status' => 'perbaikan selesai']) }}" class="filter-option {{ $statusFilter === 'perbaikan selesai' ? 'active' : '' }}">• selesai</a>
            </div>
        </div>
    </div>

    @foreach($aduan as $a)
    <div class="tile">
        <img src="{{ asset('storage/'.$a->gambar) }}">

        <div class="tile-text">
            <div><b>area:</b> {{ $a->zona->nama }}</div>
            <div><b>keterangan:</b> {{ Str::limit($a->keterangan, 40) }}</div>
            <div class="
                {{ $a->status=='diadukan' ? 'status-diadu' : '' }}
                {{ $a->status=='diproses' ? 'status-diproses' : '' }}
                {{ $a->status=='perbaikan selesai' ? 'status-selesai' : '' }}
            ">
                <b>status:</b> {{ $a->status }}
            </div>
            <div class="timestamp">
                tanggal ajukan {{ $a->created_at->format('d F Y') }} jam {{ $a->created_at->format('H:i') }}
                @if($a->status === 'perbaikan selesai')
                    <br>
                    tanggal selesai {{ $a->updated_at->format('d F Y') }} jam {{ $a->updated_at->format('H:i') }}
                @endif
            </div>
        </div>

        {{-- AKSI ROLE STAF --}}
        @if(Auth::user()->role === 'staf')
            @if($a->status === 'diadukan')
                <form method="POST" action="{{ route('aduan.proses',$a->id) }}">
                    @csrf
                    <button class="btn-outline">proses aduan</button>
                </form>
            @endif

            @if($a->status === 'diproses')
                <button class="btn-outline" onclick="openSelesai({{ $a->id }})">
                    selesaikan proses
                </button>
            @endif
        @endif

        {{-- RATING SANTRI --}}
        @if(Auth::user()->role === 'santri' 
            && $a->status === 'perbaikan selesai' 
            && !$a->sudahRating(Auth::id()))
            <form method="POST" action="{{ route('aduan.rating',$a->id) }}" style="display:flex; flex-direction:column; gap:5px;">
                @csrf
                <select name="value">
                    @for($i=1;$i<=5;$i++)
                        <option value="{{ $i }}">{{ $i }}★</option>
                    @endfor
                </select>
                <button class="btn-outline">kirim rating</button>
            </form>
        @endif
    </div>
    @endforeach

    @if(Auth::user()->role==='santri')
        <button class="btn-outline btn-create" onclick="location.href='/dashboard'">
            buat aduan baru
        </button>
    @endif
</div>

{{-- POPUP BUAT ADUAN (SANTRI) --}}
@if(request('zona') && Auth::user()->role==='santri')
<div class="overlay" id="popup" style="display:flex">
    <form class="popup" method="POST" action="/aduan/store" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="zona_id" value="{{ request('zona') }}">
        <div class="popup-close" onclick="closePopup()">✕</div>

        <label class="upload-box">
            <input type="file" name="gambar" hidden required>
            <div>＋</div>
            <div>bukti objek bermasalah</div>
        </label>

        <textarea name="keterangan" placeholder="Keterangan (opsional)"></textarea>

        <button class="btn-outline" style="margin-top:16px;width:100%">
            buat aduan
        </button>
    </form>
</div>
@endif

{{-- POPUP SELESAIKAN (STAF) --}}
<div class="overlay" id="popup-selesai">
    <form class="popup" method="POST" enctype="multipart/form-data" id="form-selesai">
        @csrf
        <div class="popup-close" onclick="closeSelesai()">✕</div>

        <label class="upload-box">
            <input type="file" name="bukti_selesai" hidden required>
            <div>＋</div>
            <div>bukti proses selesai</div>
        </label>

        <button class="btn-outline" style="margin-top:16px;width:100%">
            selesaikan proses
        </button>
    </form>
</div>

{{-- NAV --}}
<div class="nav-bottom">
    <a href="{{ route('dashboard') }}"
       class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        jelajah
    </a>

    <a href="{{ route('aduan.index') }}"
       class="nav-item {{ request()->routeIs('aduan.*') ? 'active' : '' }}">
        aduan
    </a>

    <a href="/profil"
       class="nav-item {{ request()->is('profil') ? 'active' : '' }}">
        akun
    </a>
</div>


<script>
// Filter Dropdown
const filterBtn = document.getElementById('filterBtn');
const filterMenu = document.getElementById('filterMenu');

if (filterBtn && filterMenu) {
    filterBtn.addEventListener('click', function() {
        filterMenu.classList.toggle('show');
    });

    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.filter-dropdown-container')) {
            filterMenu.classList.remove('show');
        }
    });
}

// Fungsi untuk popup Santri
function closePopup() {
    const popup = document.getElementById('popup');
    if (popup) popup.style.display = 'none';
}

// Fungsi untuk popup Staf (Selesaikan)
function openSelesai(id){
    document.getElementById('popup-selesai').style.display='flex';
    document.getElementById('form-selesai').action = `/aduan/${id}/selesai`;
}

function closeSelesai(){
    document.getElementById('popup-selesai').style.display='none';
}
</script>

</body>
</html>