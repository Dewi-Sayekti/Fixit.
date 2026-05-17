<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FIXIT - Jelajah</title>

<style>
    @font-face {
        font-family: 'Brigends';
        src: url('/fonts/BrigendsExpanded.otf') format('opentype');
    }
    @font-face {
        font-family: 'Graphite';
        src: url('/fonts/GraphiteDEMO.otf') format('opentype');
    }

    body {
        margin: 0;
        background: #102B57;
        font-family: 'Graphite', sans-serif;
        color: white;
        overflow-x: hidden;
    }

    /* HEADER */
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
        font-family: 'Graphite';
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 6px;
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


    .username-text {
        font-size: 15px;
        margin-bottom: 2px;
    }

    .role-badge { /* ADDED - moved under username */
        background:white ;
        padding: 3px 10px;
        font-size: 12px;
        border-radius: 6px;
        font-weight: bold;
        color: #102B57;
    }

    .dropdown-floor { /* ADDED - placed under role-badge */
        border: 1.5px solid white;
        background: transparent;
        color: white;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 14px;
        cursor: pointer;
        margin-top: 4px;
        font-family: 'Graphite';
    }

    /* MAP
    .map-container {
        position: auto;
        width: 100%;
        max-width: 720px;
        margin: 0 auto;
        margin-top: 10px;
        justify-content: center;
    }

    .map-image {
        width: 118%;
        display: block;
        border-radius: 18px;
    } */

    /* MAP */
.map-container {
    position: relative;      
    width: 100%;
    max-width: 720px;
    margin: 0 auto;
    margin-top: 10px;

    display: flex;           
    justify-content: center;
}

.map-image {
    width: 200%;    /* lebih kecil, bisa disesuaikan */
    max-width: 750px;
    height: auto;   /* menjaga proporsi */
    display: block;
    border-radius: 18px;

    margin-left: auto; 
    margin-right: auto;
}


    /* TILE PILIH ZONA */
    .bounding-box {
        position: absolute;
        border: 3px solid #213158;
        border-radius: 10px;
        display: none;
        pointer-events: none;
    }

    .poly-click {
        position: absolute;
        cursor: pointer;
        opacity: 0;
    }

    /* LIST TILE PUTIH DI ATAS NAV (ADDED) */
    .list-tile { /* ADDED */
        width: 86%;
        margin: 20px auto 60px auto;
        background: #ffffff;
        padding: 22px 26px;
        border-radius: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #102B57;
        font-size: 20px;
        font-weight: bold;
    }

    .btn-outline {
        border: 2px solid #102B57;
        background: transparent;
        color: #102B57;
        padding: 8px 22px;
        border-radius: 30px;
        cursor: pointer;
        font-family: 'Graphite';
    }

    /* NAVIGATION */
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
    .nav-fas{
        font-size: 16px;
        cursor: pointer;
    }

    .map-svg svg {
    width: 200%;
    max-width: 750px;
    height: auto;
}

/* ZONA DEFAULT */
.zona {
    fill: transparent;
    cursor: pointer;
    transition: all 0.2s ease;
}

/* HOVER */
.zona:hover {
    fill: rgba(255,255,255,0.15);
    stroke: #ffffff;
    stroke-width: 2;
    transform: scale(1.004);
}

/* TOOLTIP RATING */
#zona-rating-tooltip {
    position: absolute;
    padding: 6px 10px;
    background: rgba(0,0,0,0.75);
    color: #fff;
    font-size: 12px;
    border-radius: 6px;
    pointer-events: none;

    opacity: 0;
    /* transform: translateX(-50%); default di atas target */
    transition: opacity .2s ease, transform .2s ease;
}

#zona-rating-tooltip.show {
    opacity: 1;
    transform: translateY(0);
}

/* ZONA TERPILIH (PERSIST) */
.zona.selected {
    fill: rgba(255,255,255,0.25);
    stroke: #ffffff;
    stroke-width: 3;
    filter: drop-shadow(0 0 8px white);
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
        <select class="dropdown-floor">
            <option>Lantai 1</option>
        </select>
    </div>
</div>

{{-- MAP --}}
<div class="map-container">
    <div id="zona-rating-tooltip"></div>

    <div class="map-svg">
        @include('svg.baitur')
    </div>    

    <div id="bbox" class="bounding-box"></div>

    {{-- INVISIBLE POLYGON CLICK --}}
    @foreach($zona as $z)
        @php
            if (!is_array($z->polygon) || count($z->polygon) < 4) continue;
            $arr = $z->polygon;
            $xs=[]; $ys=[];
            foreach($arr as $i=>$v){ if($i%2==0) $xs[]=$v; else $ys[]=$v; }
            $minX=min($xs); $maxX=max($xs);
            $minY=min($ys); $maxY=max($ys);
        @endphp

        <div class="poly-click"
             data-id="{{ $z->id }}"
             data-nama="{{ $z->nama }}"
             data-rating="{{ $z->rating_agg }}"
             style="
                left:{{ $minX }}px;
                top:{{ $minY }}px;
                width:{{ $maxX - $minX }}px;
                height:{{ $maxY - $minY }}px;
             ">
        </div>
    @endforeach

</div>


{{-- LIST TILE “LOBBY UTAMA + BUAT ADUAN BARU” (ADDED) --}}
<div class="list-tile">
    <div id="zona-nama">Pilih zona</div>

    @if(Auth::user()->role === 'santri')
        <button id="btn-aduan" class="btn-outline" disabled>
            buat aduan baru
        </button>
    @endif
</div>



{{-- NAVIGATION --}}
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
    document.addEventListener('DOMContentLoaded', () => {
    
        const zonas = @json($zona->keyBy('id'));
    
        const tooltip   = document.getElementById('zona-rating-tooltip');
        const zonaNama  = document.getElementById('zona-nama');
        const btnAduan  = document.getElementById('btn-aduan');
    
        let hoveredZonaId  = null;
        let selectedZonaId = null;
    
        document.querySelectorAll('.zona').forEach(zona => {
    
            const zonaId = zona.dataset.zonaId;
    
            /* =====================
               HOVER → TOOLTIP RATING
            ====================== */
            zona.addEventListener('mouseenter', () => {
    hoveredZonaId = zonaId;

    const rating = zonas[zonaId]?.rating_agg ?? 0;
    tooltip.innerText = `⭐ ${rating.toFixed(1)}`;
    tooltip.classList.add('show');

    // hitung posisi tooltip berdasar bounding box zona
    const bbox = zona.getBBox();
    const svgRect = zona.ownerSVGElement.getBoundingClientRect();
    const containerRect = document.querySelector('.map-container').getBoundingClientRect();

    // posisi center di atas zona
    const left = svgRect.left - containerRect.left + bbox.x + bbox.width / 6;
    const top  = svgRect.top - containerRect.top + bbox.y - 58; // sedikit di atas

    tooltip.style.left = left + 'px';
    tooltip.style.top  = top + 'px';
});

zona.addEventListener('mouseleave', () => {
    hoveredZonaId = null;
    tooltip.classList.remove('show');
});

    
            /* =====================
               CLICK → PILIH ZONA
            ====================== */
            zona.addEventListener('click', () => {
    
                // reset semua zona
                document.querySelectorAll('.zona')
                    .forEach(z => z.classList.remove('selected'));
    
                zona.classList.add('selected');
                selectedZonaId = zonaId;
    
                // TILE → hanya dengar SELECTED
                zonaNama.innerText = zonas[zonaId].nama;
    
                // enable tombol aduan
                if (btnAduan) {
                    btnAduan.disabled = false;
                }
    
                console.log('Zona dipilih:', zonaId);
            });
        });
    
        /* =====================
           TOOLTIP POSITION
        ====================== */
        function moveTooltip(e) {
            tooltip.style.left = (e.pageX + 12) + 'px';
            tooltip.style.top  = (e.pageY - 10) + 'px';
        }
    
        /* =====================
           BUTTON ADUAN
        ====================== */
        if (btnAduan) {
            btnAduan.addEventListener('click', () => {
                if (!selectedZonaId) return;
    
                // contoh: redirect sambil bawa zona_id
                window.location.href = `/aduan?zona=${selectedZonaId}`;

            });
        }
    
    });
    </script>
    
    

</body>
</html>
