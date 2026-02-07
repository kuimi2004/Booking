<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="booking2";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

// ดึงข้อมูลผู้ใช้
$sql = "SELECT * FROM admin WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hotel Booking | Luxury Stay</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary-color: #0b2c4d;
    --accent-color: #c5a47e; /* Gold/Beige for luxury feel */
    --text-light: #f8f9fa;
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

body {
    background: linear-gradient(rgba(11, 44, 77, 0.7), rgba(11, 44, 77, 0.7)),
                url("./image/1.jpeg") center/cover no-repeat fixed;
    font-family: 'Poppins', 'Noto Sans Thai', sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    color: #333;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.8s ease-out forwards;
}

/* ===== NAVBAR ===== */
.navbar {
    background: rgba(11, 44, 77, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding: 15px 0;
    transition: all 0.3s;
}

.hotel-brand {
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: 1px;
    color: #fff !important;
    text-transform: uppercase;
}

.nav-link {
    color: rgba(255,255,255,0.85) !important;
    font-weight: 500;
    margin: 0 10px;
    position: relative;
    transition: 0.3s;
    font-size: 0.95rem;
}

.nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -5px;
    width: 0;
    height: 2px;
    background: var(--accent-color);
    transition: 0.3s;
    transform: translateX(-50%);
}

.nav-link:hover {
    color: var(--accent-color) !important;
}

.nav-link:hover::after {
    width: 80%;
}

.btn-nav-logout {
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 50px;
    padding: 6px 20px;
    color: white;
    transition: 0.3s;
}

.btn-nav-logout:hover {
    background: white;
    color: var(--primary-color);
    border-color: white;
}

/* ===== HERO SECTION ===== */
.hero-section {
    padding: 160px 0 60px;
    text-align: center;
    color: white;
    margin-bottom: 40px;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.2rem;
    font-weight: 300;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

/* ===== HOTEL CARD ===== */
.hotel-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: var(--card-shadow);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    position: relative;
}

.hotel-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--hover-shadow);
}

.card-img-wrapper {
    overflow: hidden;
    height: 220px;
    position: relative;
}

.hotel-card img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.hotel-card:hover img {
    transform: scale(1.1);
}

.card-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(11, 44, 77, 0.8);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(4px);
}

.hotel-card .card-body {
    padding: 20px;
}

.hotel-name {
    font-weight: 700;
    font-size: 1.15rem;
    margin-bottom: 8px;
    color: var(--primary-color);
}

.location {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.price-tag {
    color: var(--primary-color);
    font-size: 1.25rem;
    font-weight: 700;
}

.price-sub {
    font-size: 0.8rem;
    color: #999;
    font-weight: 400;
}

.btn-view {
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-weight: 500;
    margin-top: 15px;
    transition: 0.3s;
}

.btn-view:hover {
    background: #0d3d6b;
    color: white;
    transform: translateY(-2px);
}

/* ===== FOOTER ===== */
.footer {
    margin-top: auto;
    background: #061a2e;
    color: rgba(255,255,255,0.7);
    padding: 60px 0 30px;
    border-top: 5px solid var(--accent-color);
}

.footer h5 {
    color: white;
    font-weight: 700;
    margin-bottom: 20px;
}

.footer-link {
    display: block;
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    margin-bottom: 10px;
    transition: 0.3s;
}

.footer-link:hover {
    color: var(--accent-color);
    padding-left: 5px;
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="./index.php">
      <img src="../image/hotellogo.png" width="45" alt="Logo" class="rounded-circle border border-2 border-light">
      <span class="hotel-brand">MeeHotel</span>
    </a>
    
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
        <a class="nav-link" href="./user.php">
          <i class="bi bi-person-plus-fill me-1"></i> ผู้ใช้
        </a>
      </li>

     
        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
          <a class="btn-nav-logout text-decoration-none" href="./logout.php">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

     
<!-- MAIN CONTENT -->
<div class="container pb-5">

     
<header class="hero-section fade-in">
    <div class="container">
        <h1 class="hero-title">ยินดีต้อนรับผู้ดูแลระบบ</h1>
        <p class="hero-subtitle">ระบบบริหารจัดการการจองห้องพักออนไลน์ของโรงเเรมมี่โฮเทล</p>
    </div>
</header>



<div class="container page-space">
    <div class="admin-card">
        <div class="card shadow-lg border-0 text-center p-4 fade-in" style="max-width:500px;margin:40px auto;background:rgba(255,255,255,0.98);border-radius:18px;">
            <div class="d-flex flex-column align-items-center mb-3">
                <div class="position-relative mb-2">
                    <img src="../image/admin.jpg" class="rounded-circle border border-3 border-warning" style="width:110px;height:110px;object-fit:cover;box-shadow:0 8px 24px rgba(11,44,77,.15);" alt="Admin" onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=c5a47e&color=fff'">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark shadow" style="font-size:1rem;">ADMIN</span>
                </div>
                <h3 class="mb-1" style="color:#0b2c4d;font-weight:700;">ยินดีต้อนรับผู้ดูแลระบบ</h3>
                <p class="text-secondary mb-3">ระบบบริหารจัดการการจองห้องพักออนไลน์ของโรงแรม MeeHotel</p>
            </div>
            <div class="row g-3 text-start justify-content-center mb-3">
                <div class="col-sm-6">
                    <div class="mb-2"><span class="profile-label"><i class="bi bi-person-fill me-1"></i>ชื่อ :</span> <?= htmlspecialchars($admin['name']) ?></div>
                    <div class="mb-2"><span class="profile-label"><i class="bi bi-person-badge me-1"></i>นามสกุล :</span> <?= htmlspecialchars($admin['lastname']) ?></div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2"><span class="profile-label"><i class="bi bi-envelope-fill me-1"></i>อีเมล :</span> <?= htmlspecialchars($admin['email']) ?></div>
                    <div class="mb-2"><span class="profile-label"><i class="bi bi-telephone-fill me-1"></i>เบอร์โทร :</span> <?= htmlspecialchars($admin['phone']) ?></div>
                </div>
                <div class="col-12">
                    <div class="mb-2"><span class="profile-label"><i class="bi bi-geo-alt-fill me-1"></i>ที่อยู่ :</span> <?= htmlspecialchars($admin['address']) ?></div>
                </div>
            </div>
        
        </div>
    </div>
</div>
  </div>
</div>

<!-- FOOTER -->
<footer class="footer mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <h5 class="text-white mb-3">MeeHotel</h5>
                <p class="small text-white-50">
                    เราให้บริการจองห้องพักที่ดีที่สุดในราคาที่คุ้มค่า 
                    พร้อมประสบการณ์การพักผ่อนที่คุณจะไม่มีวันลืม
                </p>
            </div>
            <div class="col-md-3 offset-md-1">
                <h5>เมนู</h5>
                <a href="#" class="footer-link">หน้าหลัก</a>
                <a href="#" class="footer-link">ค้นหาโรงแรม</a>
                <a href="#" class="footer-link">โปรโมชั่น</a>
            </div>
            <div class="col-md-3">
                <h5>ติดต่อเรา</h5>
                <div class="d-flex gap-3 mt-2">
                    <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-line"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-5 pt-4 border-top border-secondary">
            <small>&copy; 2024 MeeHotel. All Rights Reserved.</small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
