<?php
include 'config/koneksi.php';

// Hitung statistik untuk dashboard depan
$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aspirasi"));
$selesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aspirasi WHERE status='selesai'"));
$proses = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM aspirasi WHERE status='proses'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Aspirasi Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <style>
        
        /* GLOBAL */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(180deg, #f8f9fa, #eef1f5);
    overflow-x: hidden;
}

/* ================= HERO ================= */
.hero-section {
    position: relative;
    min-height: 100vh;          /* bikin hero lebih tinggi */
    display: flex;
    align-items: center;       /* konten tetap di tengah */
    background-image: linear-gradient(
        rgba(13, 110, 253, 0.75),
        rgba(102, 16, 242, 0.75)
    ),
    url('https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2024/10/30/9547197-647547180.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #fff;
    padding: 160px 0 200px;   /* bawah lebih panjang */
}


/* GLOW DECORATION */
.hero-section::after {
    content: "";
    position: absolute;
    bottom: -120px;
    right: -120px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.25), transparent 70%);
    filter: blur(40px);
}

/* ================= STAT CARD ================= */
.stat-card {
    background: #fff;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.stat-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 22px 40px rgba(0,0,0,0.18);
}

/* ICON STAT */
.stat-card i {
    font-size: 32px;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ================= NAVBAR (AMAN) ================= */
.navbar {
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

/* ================= BUTTON ================= */
.btn-login {
    border-radius: 50px;
    padding: 10px 32px;
    font-weight: 600;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    border: none;
    color: #fff;
    transition: 0.3s;
}

.btn-login:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(13,110,253,0.45);
}

/* ================= SECTION SPACING ================= */
section {
    padding: 80px 0;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .hero-section {
        padding: 110px 0;
        text-align: center;
    }
}

    
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="">
    <img src="logo.jpg" alt="Logo SMK Krian 1 Sidoarjo">
    <span>SMK KRIAN 1 SIDOARJO</span>
</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                      <li class="nav-item">
                    <a class="nav-link active" href="#beranda">Beranda</a>
                </li>
    <a class="nav-link px-3" href="#fitur">Fitur Unggulan</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#statistik">Statistik</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#data">Data Pengaduan</a></li>
                <a class="btn btn-primary btn-login ms-lg-3" href="login.php">
    <i class="fa fa-sign-in-alt"></i> Login Siswa / Admin</a>
            </ul>
        </div>
    </div>
</nav>

<style>
/* SMOOTH SCROLL */
html {
    scroll-behavior: smooth;
}

/* ================= NAVBAR ================= */
.navbar {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: transparent;
    padding: 18px 0;
    transition: all 0.4s ease;
}

/* NAVBAR SAAT SCROLL */
.navbar.scrolled {
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(12px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    padding: 12px 0;
}

/* ================= BRAND ================= */
.navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: 1px;
    transition: color 0.3s ease;
}

.navbar-brand img {
    width: 48px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(13,110,253,0.4);
}

/* ================= MENU ================= */
.navbar-nav .nav-link {
    font-weight: 500;
    padding: 8px 14px;
    position: relative;
    transition: all 0.3s ease;
}

/* GARIS HOVER */
.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -4px;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    border-radius: 10px;
    transform: translateX(-50%);
    transition: width 0.3s ease;
}

.navbar-nav .nav-link:hover::after {
    width: 60%;
}

.navbar-nav .nav-link:hover {
    transform: translateY(-2px);
}

/* ================= WARNA KONDISI ================= */
.navbar:not(.scrolled) .nav-link,
.navbar:not(.scrolled) .navbar-brand {
    color: #fff !important;
}

.navbar.scrolled .nav-link,
.navbar.scrolled .navbar-brand {
    color: #333 !important;
}

/* ================= BUTTON LOGIN ================= */
.btn-login {
    border-radius: 50px;
    padding: 8px 24px;
    font-weight: 600;
    border: none;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: #fff;
    box-shadow: 0 10px 25px rgba(13,110,253,0.35);
    transition: all 0.3s ease;
}

.navbar:not(.scrolled) .btn-login {
    background: #fff;
    color: #0d6efd;
}

.btn-login:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 18px 35px rgba(102,16,242,0.45);
}

/* ================= MOBILE ================= */
@media (max-width: 991px) {
    .navbar {
        padding: 12px 0;
    }

    .navbar-collapse {
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 18px;
        margin-top: 12px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .navbar:not(.scrolled) .nav-link,
    .navbar:not(.scrolled) .navbar-brand {
        color: #333 !important;
    }

    .btn-login {
        width: 100%;
        margin-top: 10px;
        text-align: center;
    }
}
/* BRAND WRAPPER */
.navbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* LOGO IMAGE */
.navbar-brand img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 12px;
    padding: 6px;
    background: #fff;
    box-shadow:
        0 6px 18px rgba(13,110,253,0.35),
        inset 0 0 0 2px rgba(13,110,253,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* EFEK HOVER LOGO */
.navbar-brand:hover img {
    transform: rotate(-2deg) scale(1.05);
    box-shadow:
        0 12px 28px rgba(102,16,242,0.45),
        inset 0 0 0 2px rgba(102,16,242,0.25);
}

/* TEXT BRAND */
.navbar-brand span {
    font-size: 1.05rem;
    line-height: 1.2;
}

/* WARNA SAAT NAVBAR TRANSPARAN */
.navbar:not(.scrolled) .navbar-brand span {
    color: #fff;
}

/* WARNA SAAT SCROLL */
.navbar.scrolled .navbar-brand span {
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .navbar-brand span {
        font-size: 0.95rem;
    }
}
/* BUTTON LOGIN UTAMA */
.btn-login {
    position: relative;
    overflow: hidden;
    border-radius: 50px;
    padding: 10px 34px;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    border: none;
    color: #fff;
    box-shadow: 0 10px 25px rgba(13,110,253,0.4);
    transition: all 0.35s ease;
}

/* ICON (OPSIONAL) */
.btn-login i {
    margin-right: 8px;
}

/* EFEK HOVER */
.btn-login:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 18px 40px rgba(102,16,242,0.5);
}

/* EFEK KILAU */
.btn-login::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -75%;
    width: 50%;
    height: 200%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.5),
        transparent
    );
    transform: rotate(25deg);
    transition: 0.6s;
}

.btn-login:hover::before {
    left: 130%;
}

/* KONDISI NAVBAR TRANSPARAN */
.navbar:not(.scrolled) .btn-login {
    background: #fff;
    color: #0d6efd;
    box-shadow: 0 8px 20px rgba(255,255,255,0.35);
}

/* MOBILE */
@media (max-width: 991px) {
    .btn-login {
        width: 100%;
        text-align: center;
        margin-top: 12px;
    }
}

</style>

<header id="beranda" class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Sistem Pengaduan Sarana & Prasarana</h1>
        <p class="lead">Platform resmi SMK Krian 1 Sidoarjo untuk menyampaikan laporan kerusakan fasilitas sekolah secara cepat, transparan, dan terstruktur.</p>
        <a href="login.php" class="btn btn-light btn-lg mt-3 fw-bold text-primary px-5 shadow">Kirim Pengaduan Sekarang</a>
    </div>
</header>

<style>
    .hero-section {
    min-height: 100vh; /* setinggi layar */
    display: flex;
    align-items: center; /* tengah vertikal */
    justify-content: center;
    padding-top: 80px; /* ruang navbar */
    padding-bottom: 40px;
    text-align: center;
}

</style>

<section id="fitur" class="container">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Fitur Unggulan</h2>
        <div class="mx-auto fitur-line"></div>
        <p class="text-muted mt-3">
            Sistem pengaduan modern untuk meningkatkan kenyamanan dan transparansi sekolah
        </p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="fitur-card text-center">
                <div class="fitur-icon bg-primary">
                    <i class="fas fa-bolt"></i>
                </div>
                <h5 class="fw-bold mt-3">Pelaporan Cepat</h5>
                <p class="text-muted">
                    Siswa dapat mengirim pengaduan hanya dalam hitungan detik.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="fitur-card text-center">
                <div class="fitur-icon bg-info">
                    <i class="fas fa-desktop"></i>
                </div>
                <h5 class="fw-bold mt-3">Monitoring Real-Time</h5>
                <p class="text-muted">
                    Status pengaduan dapat dipantau secara langsung dan transparan.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="fitur-card text-center">
                <div class="fitur-icon bg-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h5 class="fw-bold mt-3">Penanganan Tuntas</h5>
                <p class="text-muted">
                    Setiap laporan dipastikan ditindaklanjuti hingga selesai.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    /* ================= FITUR UNGGULAN ================= */
#fitur {
    padding: 120px 0;
}


/* GARIS JUDUL */
.fitur-line {
    width: 70px;
    height: 4px;
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    border-radius: 10px;
}

/* CARD FITUR */
.fitur-card {
    background: #fff;
    border-radius: 22px;
    padding: 36px 28px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.1);
    transition: all 0.35s ease;
    height: 100%;
}

.fitur-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.18);
}

/* ICON */
.fitur-icon {
    width: 80px;
    height: 80px;
    margin: auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 30px;
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    #fitur {
        padding: 90px 0;
    }
}

</style>

<section id="statistik" class="container" style="margin-top: 50px;">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Statistik</h2>
        <div class="mx-auto" style="width: 60px; height: 4px; background: #0d6efd;"></div>
    </div>
    <div class="row g-4 justify-content-center">
        <div class="col-md-3">
            <div class="card stat-card text-center p-4 shadow">
                <i class="fas fa-envelope-open-text fa-3x text-primary mb-3"></i>
                <h2 class="fw-bold"><?= $total ?></h2>
                <p class="text-muted mb-0">Total Laporan</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card text-center p-4 shadow border-bottom border-info">
                <i class="fas fa-spinner fa-3x text-info mb-3"></i>
                <h2 class="fw-bold"><?= $proses ?></h2>
                <p class="text-muted mb-0">Dalam Proses</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card text-center p-4 shadow border-bottom border-success">
                <i class="fas fa-check-double fa-3x text-success mb-3"></i>
                <h2 class="fw-bold"><?= $selesai ?></h2>
                <p class="text-muted mb-0">Tuntas Diperbaiki</p>
            </div>
        </div>
    </div>
</section>

<style>
    /* ================= SECTION STATISTIK ================= */
#statistik {
    margin-bottom: 20px; /* sebelumnya biasanya 80–120px */
}

/* ================= CARD STAT ================= */
.stat-card {
    position: relative;
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(10px);
    border-radius: 22px;
    padding: 30px 24px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.12);
    transition: all 0.35s ease;
    overflow: hidden;
}

/* HOVER CARD */
.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 28px 60px rgba(0,0,0,0.18);
}

/* ================= OVAL ICON ================= */
.stat-card .stat-oval {
    width: 90%;
    height: 70px;
    margin: 0 auto 22px;
    border-radius: 50%;
    background: rgba(13,110,253,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.35s ease;
}

/* ICON DI DALAM OVAL */
.stat-card .stat-oval i {
    font-size: 34px;
    color: #0d6efd;
    transition: transform 0.35s ease;
}

/* HOVER ICON */
.stat-card:hover .stat-oval i {
    transform: scale(1.15) rotate(-6deg);
}

/* ================= ANGKA ================= */
.stat-card h2 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 6px;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ================= TEXT ================= */
.stat-card p {
    font-size: 0.95rem;
    font-weight: 500;
    color: #555;
}

/* ================= STRIP WARNA BAWAH ================= */
.stat-card::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #0d6efd, #6610f2);
}

/* ================= VARIASI STATUS ================= */
.stat-card.border-info::after {
    background: linear-gradient(90deg, #0dcaf0, #0aa2c0);
}
.stat-card.border-info .stat-oval {
    background: rgba(13,202,240,0.15);
}
.stat-card.border-info i {
    color: #0dcaf0;
}

.stat-card.border-success::after {
    background: linear-gradient(90deg, #198754, #20c997);
}
.stat-card.border-success .stat-oval {
    background: rgba(25,135,84,0.15);
}
.stat-card.border-success i {
    color: #198754;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .stat-card {
        padding: 24px 18px;
    }

    .stat-card h2 {
        font-size: 2rem;
    }

    .stat-card .stat-oval {
        height: 60px;
    }
}
#statistik {
    position: relative;
}
</style>

<section id="program" class="program-section">
    <div class="container">

        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-lg">
                <div class="program-card bg-blue">
                    <div class="program-icon">💻</div>
                    <h5>Rekayasa Perangkat Lunak</h5>
                    <p>Pemrograman, web, aplikasi, dan teknologi digital.</p>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="program-card bg-red">
                    <div class="program-icon">⚙️</div>
                    <h5>Teknik Pemesinan</h5>
                    <p>Produksi, mesin industri, dan manufaktur.</p>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="program-card bg-yellow">
                    <div class="program-icon">⚡</div>
                    <h5>Teknik Instalasi Tenaga Listrik</h5>
                    <p>Instalasi listrik gedung dan industri.</p>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="program-card bg-green">
                    <div class="program-icon">🔥</div>
                    <h5>Teknik Pengelasan</h5>
                    <p>Pengelasan konstruksi dan fabrikasi.</p>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="program-card bg-gray">
                    <div class="program-icon">🚚</div>
                    <h5>Teknik Logistik</h5>
                    <p>Manajemen distribusi dan pergudangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ================= PROGRAM KEAHLIAN ================= */
.program-section {
    padding: 120px 0;
    background: linear-gradient(180deg, #f8f9fa, #eef1f5);
    margin-top: -180px;
}


/* CARD */
.program-card {
    border-radius: 24px;
    padding: 40px 28px;
    color: #fff;
    text-align: center;
    height: 100%;
    box-shadow: 0 18px 40px rgba(0,0,0,0.15);
    transition: all 0.35s ease;
}

.program-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.25);
}

/* ICON */
.program-icon {
    font-size: 42px;
    margin-bottom: 18px;
}

/* TEXT */
.program-card h5 {
    font-weight: 700;
    margin-bottom: 12px;
}

.program-card p {
    font-size: 0.95rem;
    opacity: 0.95;
}

/* WARNA */
.bg-blue {
    background: #0d47a1;
}
.bg-red {
    background: #c62828;
}
.bg-yellow {
    background: #f9a825;
    color: #fff;
}
.bg-green {
    background: #1b5e20;
}
.bg-gray {
    background: #616161;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .program-section {
        padding: 90px 0;
    }
}

</style>

<section id="data" class="container my-5 py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Data Pengaduan Terkini</h2>
        <div class="mx-auto" style="width: 60px; height: 4px; background: #0d6efd;"></div>
    </div>

    <div class="card shadow border-0 p-4">
        <div class="table-responsive">
            <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
    <div class="data-search">
        <input type="text" id="searchInput" placeholder="Cari pengaduan...">
        <i class="fas fa-search"></i>
    </div>

    <select id="filterStatus" class="filter-status">
        <option value="">Semua Status</option>
        <option value="antrean">Antrean</option>
        <option value="dikerjakan">Dikerjakan</option>
        <option value="selesai">Selesai</option>
    </select>
</div>
            <table id="tabelPublik" class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($conn, "SELECT a.*, k.keterangan_kategori FROM aspirasi a JOIN kategori k ON a.id_kategori = k.id_kategori ORDER BY a.tanggal_pelaporan DESC");
                    while($row = mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($row['tanggal_pelaporan'])) ?></td>
                        <td><?= $row['keterangan_kategori'] ?></td>
                        <td><?= $row['lokasi'] ?></td>
                        <td><?= substr($row['keterangan'], 0, 50) ?>...</td>
                        <td>
                            <?php if($row['status'] == 'menunggu'): ?>
                                <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> Antrean</span>
                            <?php elseif($row['status'] == 'proses'): ?>
                                <span class="badge bg-info"><i class="fas fa-tools"></i> Dikerjakan</span>
                            <?php else: ?>
                                <span class="badge bg-success"><i class="fas fa-check"></i> Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <script>
const searchInput = document.getElementById("searchInput");
const filterStatus = document.getElementById("filterStatus");
const rows = document.querySelectorAll("#tabelPublik tbody tr");

function filterTable() {
    const searchText = searchInput.value.toLowerCase();
    const statusFilter = filterStatus.value;

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        const status = row.querySelector(".badge")?.innerText.toLowerCase() || "";

        const matchSearch = text.includes(searchText);
        const matchStatus = statusFilter === "" || status.includes(statusFilter);

        if (matchSearch && matchStatus) {
            row.classList.remove("hide");
        } else {
            row.classList.add("hide");
        }
    });
}

searchInput.addEventListener("input", filterTable);
filterStatus.addEventListener("change", filterTable);
</script>

                </tbody>
            </table>
        </div>
    </div>
</section>

<style>
    /* ================= CARD DATA ================= */
#data .card {
    border-radius: 16px;
    padding: 18px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.1);
}

/* ================= SEARCH & FILTER ================= */
.data-search {
    max-width: 300px;
    position: relative;
}

.data-search input {
    padding: 8px 38px 8px 14px;
    font-size: 0.85rem;
}

.filter-status {
    padding: 7px 12px;
    font-size: 0.8rem;
}

/* ================= TABLE ================= */
#tabelPublik {
    font-size: 0.82rem;              /* tabel lebih kecil */
    border-collapse: separate;
    border-spacing: 0 6px;           /* jarak antar row diperkecil */
}

#tabelPublik thead th {
    font-size: 0.8rem;
    padding: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#tabelPublik tbody tr {
    background: #fff;
    border-radius: 10px;
    transition: all 0.3s ease;
}

#tabelPublik tbody tr:hover {
    transform: scale(1.01);
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

#tabelPublik tbody td {
    padding: 10px;
    vertical-align: middle;
}

/* ================= STATUS BADGE ================= */
.badge {
    font-size: 0.7rem;
    padding: 5px 10px;
    border-radius: 20px;
}

/* ================= ANIMASI FILTER ================= */
#tabelPublik tbody tr.hide {
    opacity: 0;
    transform: translateY(10px);
    pointer-events: none;
}
/* ================= CENTER 1 SCREEN ================= */
#data {
    min-height: 100vh;                 /* 1 layar penuh */
    display: flex;
    align-items: center;               /* vertikal tengah */
    scroll-margin-top: 90px;            /* aman dari navbar */
}

#data > .card,
#data > .container {
    width: 100%;
}
#data .container {
    max-width: 1100px;   /* ideal laptop */
}
@media (max-width: 768px) {
    #data {
        align-items: flex-start;
        padding-top: 100px;
    }
}
/* Judul selalu di tengah atas */
#data .text-center {
    position: absolute;
    top: 40px;               /* atur jarak dari atas */
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
}
#data {
    position: relative;
}


</style>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2026 Sistem Pengaduan SMK Krian 1 Sidoarjo</p>
    </div>
</footer>
<style>
 /* ================= FOOTER ================= */
footer {
    position: relative;
    background: linear-gradient(135deg, #0d1b2a, #1b263b) !important;
    color: #ffffff;
    padding: 50px 0 45px;
    overflow: hidden;
}

/* TEXT */
footer p {
    margin: 0;
    font-size: 0.95rem;
    letter-spacing: 0.4px;
    color: #dcdcdc;
}

/* GARIS DI BAWAH TEKS */
footer p::after {
    content: "";
    display: block;
    width: 100px;
    height: 3px;
    margin: 14px auto 0;
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    border-radius: 10px;
}

/* GLOW HALUS */
footer::after {
    content: "";
    position: absolute;
    right: -100px;
    bottom: -100px;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(13,110,253,0.25), transparent 70%);
    filter: blur(50px);
    pointer-events: none;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    footer {
        padding: 45px 15px 35px;
    }

    footer p {
        font-size: 0.9rem;
    }

    footer p::after {
        width: 80px;
    }
}

</style>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelPublik').DataTable({
            "pageLength": 5,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
<script>
    window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>

<script>
window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 50);
});
</script>

</body>
</html>