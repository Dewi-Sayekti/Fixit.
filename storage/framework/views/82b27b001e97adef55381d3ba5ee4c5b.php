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
</style>
</head>

<body>


<div class="header">
    <div>FIXIT.</div>
    <div class="top-right">
        <div class="username-text"><?php echo e(Auth::user()->username); ?></div>
        <div class="role-badge"><?php echo e(Auth::user()->role); ?></div>
    </div>
</div>


<div class="wrapper">
    <div class="judul">aduan</div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $aduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="tile">
        <img src="<?php echo e(asset('storage/'.$a->gambar)); ?>">

        <div class="tile-text">
            <div><b>area:</b> <?php echo e($a->zona->nama); ?></div>
            <div><b>keterangan:</b> <?php echo e(Str::limit($a->keterangan, 40)); ?></div>
            <div class="
                <?php echo e($a->status=='diadukan' ? 'status-diadu' : ''); ?>

                <?php echo e($a->status=='diproses' ? 'status-diproses' : ''); ?>

                <?php echo e($a->status=='perbaikan selesai' ? 'status-selesai' : ''); ?>

            ">
                <b>status:</b> <?php echo e($a->status); ?>

            </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->role === 'staf'): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($a->status === 'diadukan'): ?>
                <form method="POST" action="<?php echo e(route('aduan.proses',$a->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn-outline">proses aduan</button>
                </form>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($a->status === 'diproses'): ?>
                <button class="btn-outline" onclick="openSelesai(<?php echo e($a->id); ?>)">
                    selesaikan proses
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(Auth::user()->role === 'mahasiswa' 
            && $a->status === 'perbaikan selesai' 
            && !$a->sudahRating(Auth::id())): ?>
            <form method="POST" action="<?php echo e(route('aduan.rating',$a->id)); ?>" style="display:flex; flex-direction:column; gap:5px;">
                <?php echo csrf_field(); ?>
                <select name="value">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i=1;$i<=5;$i++): ?>
                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?>★</option>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <button class="btn-outline">kirim rating</button>
            </form>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(Auth::user()->role==='mahasiswa'): ?>
        <button class="btn-outline btn-create" onclick="location.href='/dashboard'">
            buat aduan baru
        </button>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('zona') && Auth::user()->role==='mahasiswa'): ?>
<div class="overlay" id="popup" style="display:flex">
    <form class="popup" method="POST" action="/aduan/store" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="zona_id" value="<?php echo e(request('zona')); ?>">
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
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<div class="overlay" id="popup-selesai">
    <form class="popup" method="POST" enctype="multipart/form-data" id="form-selesai">
        <?php echo csrf_field(); ?>
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


<div class="nav-bottom">
    <a href="<?php echo e(route('dashboard')); ?>"
       class="nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
        jelajah
    </a>

    <a href="<?php echo e(route('aduan.index')); ?>"
       class="nav-item <?php echo e(request()->routeIs('aduan.*') ? 'active' : ''); ?>">
        aduan
    </a>

    <a href="/profil"
       class="nav-item <?php echo e(request()->is('profil') ? 'active' : ''); ?>">
        akun
    </a>
</div>


<script>
// Fungsi untuk popup Mahasiswa
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
</html><?php /**PATH C:\xampp\fixit\resources\views/aduan.blade.php ENDPATH**/ ?>