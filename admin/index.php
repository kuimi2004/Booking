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

<title>Admin Dashboard | Hotel Booking</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Noto+Sans+Thai:wght@500;700&display=swap" rel="stylesheet">

<style>
body{
    background: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
                url("../image/1.jpeg") center/cover no-repeat fixed;
    font-family: 'Poppins','Noto Sans Thai',sans-serif;
    min-height:100vh;
}

/* ===== NAVBAR ===== */
.navbar{
    background:#0b2c4d;
    box-shadow:0 6px 20px rgba(0,0,0,.35);
}
.hotel-brand{
    font-size:1.7rem;
    font-weight:700;
    letter-spacing:1.5px;
    color:#fff;
    text-decoration:none;
    position:relative;
}
.hotel-brand::after{
    content:"";
    position:absolute;
    left:0;
    bottom:-6px;
    width:0;
    height:3px;
    background:linear-gradient(90deg,#38f9d7,#43e97b);
    transition:.4s;
}
.hotel-brand:hover::after{width:100%}

.nav-link{
    color:#fff !important;
    font-weight:500;
}
.nav-link:hover{
    color:#FDE68A !important;
}

.btn-outline-light{
    border-radius:20px;
    font-weight:600;
}

/* ===== CONTENT ===== */
.page-space{
    padding-top:150px;
}

/* ===== WELCOME CARD ===== */
.admin-card{
    max-width:520px;
    margin:auto;
    background: rgba(11,44,77,.88);
    border-radius:20px;
    padding:35px 30px;
    text-align:center;
    color:#fff;
    box-shadow:0 20px 40px rgba(0,0,0,.45);
    backdrop-filter: blur(8px);
}

.admin-card h3{
    font-weight:700;
    margin-bottom:8px;
}

.admin-card p{
    font-size:1rem;
    color:#dbeafe;
    margin-bottom:20px;
}

/* ===== PROFILE IMAGE ===== */
.profile-img{
    width:180px;
    height:180px;
    object-fit:cover;
    border-radius:50%;
    margin:0 auto 20px;
    border:3px solid rgba(255,255,255,.7);
    box-shadow:0 12px 30px rgba(0,0,0,.5);
    transition:.35s;
}
.profile-img:hover{
    transform:scale(1.05);
}

/* ===== QUICK ACTION ===== */
.quick-actions a{
    margin:6px;
    border-radius:25px;
    font-weight:600;
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

<!-- CONTENT -->
<div class="container page-space">
    <div class="admin-card">

        <img src="../image/admin.jpg" class="profile-img" alt="Admin">

        <h3>ยินดีต้อนรับผู้ดูแลระบบ</h3>
        <p>ระบบบริหารจัดการการจองห้องพักออนไลน์ของโรงเเรมมี่โฮเทล</p>


  <div class="text-start">
          <p><span class="profile-label">ชื่อ :</span> <?= htmlspecialchars($admin['name']) ?></p>
          <p><span class="profile-label">นามสกุล :</span> <?= htmlspecialchars($admin['lastname']) ?></p>
          <p><span class="profile-label">อีเมล :</span> <?= htmlspecialchars($admin['email']) ?></p>
          <p><span class="profile-label">เบอร์โทร :</span> <?= htmlspecialchars($admin['phone']) ?></p>
          <p><span class="profile-label">ที่อยู่ :</span> <?= htmlspecialchars($admin['address']) ?></p>
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
