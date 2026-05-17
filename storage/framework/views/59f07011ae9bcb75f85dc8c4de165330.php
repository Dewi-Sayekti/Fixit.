<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FIXIT - Profil</title>

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
}

.role-badge {
    background: white;
    padding: 3px 10px;
    font-size: 12px;
    border-radius: 6px;
    font-weight: bold;
    color: #102B57;
}

/* ================= CARD ================= */
.card {
    width: 88%;
    background: white;
    padding: 26px;
    border-radius: 26px;
    margin: 30px auto 120px;
    color: #102B57;
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 24px;
}

.profile-row {
    display: flex;
    align-items: center;
    gap: 20px;
}

.avatar {
    width: 64px;
    height: 64px;
    background: #d0dae9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: bold;
    color: #102B57;
}

.profile-info {
    font-size: 15px;
}

.btn-logout {
    margin-top: 30px;
    background: #e53935;
    border: none;
    color: white;
    padding: 10px 26px;
    border-radius: 30px;
    cursor: pointer;
    font-family: 'Graphite';
    font-size: 14px;
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


<div class="card">
    <div class="card-title">Profil & akun</div>

    <div class="profile-row">
        <div class="avatar">
            <?php echo e(strtolower(substr(Auth::user()->username, 0, 1))); ?>

        </div>

        <div class="profile-info">
            <div><b><?php echo e(Auth::user()->username); ?></b></div>
            <div><?php echo e(Auth::user()->role); ?></div>
        </div>
    </div>

    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button class="btn-logout">Keluar</button>
    </form>
</div>


<div class="nav-bottom">
    <div class="nav-item" onclick="location.href='/dashboard'">jelajah</div>
    <div class="nav-item" onclick="location.href='/aduan'">aduan</div>
    <div class="nav-item active">akun</div>
</div>

</body>
</html>
<?php /**PATH C:\xampp\fixit\resources\views/profil.blade.php ENDPATH**/ ?>