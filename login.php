<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Cek Admin
    $queryAdmin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    // Cek Siswa
    $querySiswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$user' AND password='$pass'");

    if (mysqli_num_rows($queryAdmin) > 0) {
        $_SESSION['role'] = 'admin';
        $_SESSION['user'] = $user;
        header("Location: admin/dashboard.php");
    } elseif (mysqli_num_rows($querySiswa) > 0) {
        $data = mysqli_fetch_assoc($querySiswa);
        $_SESSION['role'] = 'siswa';
        $_SESSION['user'] = $data['nis'];
        header("Location: siswa/form_aspirasi.php");
    } else {
        echo "<script>alert('Username/NIS atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Pengaduan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #f4f6f9; height: 100vh; display: flex; align-items: center; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .btn-primary { background: #4e73df; border: none; border-radius: 10px; padding: 12px; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <i><img src="logo.jpg" width="50px" alt=""></i>
                    <h4>Pengaduan Sekolah</h4>
                    <p class="text-muted">Silakan Login</p>
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <label>Username / NIS</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan ID Anda" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="******" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Login Sekarang</button>
                    <div class="text-center mt-3">
    <p class="text-muted small">Belum punya akun? <a href="register.php" class="text-primary fw-bold">Daftar Sekarang</a></p>
    <a href="index.php" class="text-secondary small"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
</div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* ===== GLOBAL ===== */
body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    font-family: 'Segoe UI', sans-serif;
    background:
        radial-gradient(circle at top right, rgba(255,255,255,0.15), transparent 40%),
        linear-gradient(135deg, #0d1b2a, #1b263b, #415a77);
}


/* ===== CARD LOGIN ===== */
.card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    animation: fadeUp 0.6s ease;
}

/* ===== LOGO ===== */
.card img {
    margin-bottom: 10px;
}

/* ===== JUDUL ===== */
.card h4 {
    font-weight: 700;
    color: #2c2c2c;
}

.card p {
    font-size: 0.9rem;
}

/* ===== INPUT ===== */
.form-control {
    border-radius: 12px;
    padding: 10px 14px;
    font-size: 0.9rem;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 3px rgba(78,115,223,0.2);
}

/* ===== LABEL ===== */
label {
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 6px;
}

/* ===== BUTTON ===== */
.btn-primary {
    background: linear-gradient(135deg, #4e73df, #6f7dff);
    border: none;
    border-radius: 14px;
    padding: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(78,115,223,0.35);
}

/* ===== LINK ===== */
a {
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* ===== ANIMASI ===== */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.card {
    border: none;
    border-radius: 18px;
    padding: 30px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    animation: fadeUp 0.6s ease;
}

</style>

</body>
</html>