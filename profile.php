<?php
session_start();
include 'connect.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

// ดึงข้อมูลผู้ใช้
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>โปรไฟล์ | MeeHotel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
body {
  background: linear-gradient(rgba(11, 44, 77, 0.7), rgba(11, 44, 77, 0.7)), url("./image/1.jpeg") center/cover no-repeat fixed;
  font-family: 'Poppins', 'Noto Sans Thai', sans-serif;
  min-height: 100vh;
  color: #333;
}
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
  background: #c5a47e;
  transition: 0.3s;
  transform: translateX(-50%);
}
.nav-link:hover {
  color: #c5a47e !important;
}
.nav-link:hover::after {
  width: 80%;
}
.profile-card {
  background: rgba(255,255,255,0.98);
  border-radius: 20px;
  padding: 36px 32px 28px 32px;
  box-shadow: 0 8px 32px rgba(11,44,77,0.13);
  margin-bottom: 32px;
}
.profile-label {
  font-weight: 600;
  color: #0b2c4d;
}
#profileImg {
  width: 110px;
  height: 110px;
  object-fit: cover;
  box-shadow: 0 8px 24px rgba(11,44,77,.15);
}
.vip-badge {
  font-size: 1rem;
  background: linear-gradient(90deg, #c5a47e 0%, #0b2c4d 100%);
  color: #fff;
  border-radius: 12px;
  padding: 4px 16px;
  position: absolute;
  top: 0;
  left: 100%;
  transform: translate(-50%, -30%);
  box-shadow: 0 2px 8px rgba(197,164,126,0.08);
}
.btn-primary, .btn-primary:active, .btn-primary:focus {
  background: linear-gradient(90deg, #c5a47e 0%, #0b2c4d 100%);
  border: none;
  font-weight: 600;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(197,164,126,0.08);
}
.btn-primary:hover {
  background: linear-gradient(90deg, #0b2c4d 0%, #c5a47e 100%);
}
.btn-outline-secondary {
  border-radius: 10px;
  font-weight: 600;
}
.page-space {
  padding-top: 110px;
}
.fade-in {
  animation: fadeIn 0.8s ease-out forwards;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.toast-success {
  background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
  color: #fff;
  font-weight: 600;
  border-radius: 10px;
}
.back-btn {
  margin-bottom: 18px;
  background: #fff;
  color: #0b2c4d;
  border: 1px solid #c5a47e;
  border-radius: 10px;
  font-weight: 600;
  transition: 0.2s;
}
.back-btn:hover {
  background: #c5a47e;
  color: #fff;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="./index.php">
      <img src="./image/hotellogo.png" width="45" alt="Logo" class="rounded-circle border border-2 border-light">
      <span class="hotel-brand">MeeHotel</span>
    </a>
    
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link" href="./profile.php">โปรไฟล์</a>
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
    <a href="./index.php" class="btn back-btn"><i class="bi bi-arrow-left"></i> กลับไปหน้าหลัก</a>
  <div class="row justify-content-center fade-in">
    <div class="col-lg-7 col-md-9">
      <div class="profile-card text-center shadow-lg border-0" style="background:rgba(255,255,255,0.97);">
        <div class="d-flex flex-column align-items-center mb-3">
          <div class="position-relative">
            <img src="./image/user_avatar.png" alt="Profile" class="rounded-circle border border-3 border-primary" id="profileImg" onerror="this.src='https://ui-avatars.com/api/?name=<?=urlencode($user['name'].' '.$user['lastname'])?>&background=0b2c4d&color=fff'">
            <span class="vip-badge">VIP</span>
          </div>
          <h4 class="mt-3 mb-2" style="color:#0b2c4d;font-weight:700;">ข้อมูลส่วนตัว</h4>
        </div>
        <div class="row g-3 text-start justify-content-center">
          <div class="col-sm-6">
            <div class="mb-2"><span class="profile-label"><i class="bi bi-person-fill me-1"></i>ชื่อ :</span> <?= htmlspecialchars($user['name']) ?></div>
            <div class="mb-2"><span class="profile-label"><i class="bi bi-person-badge me-1"></i>นามสกุล :</span> <?= htmlspecialchars($user['lastname']) ?></div>
            <div class="mb-2"><span class="profile-label"><i class="bi bi-person-lines-fill me-1"></i>ชื่อผู้ใช้ :</span> <?= htmlspecialchars($user['username']) ?></div>
          </div>
          <div class="col-sm-6">
            <div class="mb-2"><span class="profile-label"><i class="bi bi-envelope-fill me-1"></i>อีเมล :</span> <?= htmlspecialchars($user['email']) ?></div>
            <div class="mb-2"><span class="profile-label"><i class="bi bi-telephone-fill me-1"></i>เบอร์โทร :</span> <?= htmlspecialchars($user['phone']) ?></div>
            <div class="mb-2"><span class="profile-label"><i class="bi bi-geo-alt-fill me-1"></i>ที่อยู่ :</span> <?= htmlspecialchars($user['address']) ?></div>
          </div>
        </div>

        <hr class="my-4">

  <div class="row g-3 text-start justify-content-center">
          <div class="col-sm-6">
            <div class="mb-2"><span class="profile-label"><i class="bi bi-person-fill me-1"></i>Roomname :</span> <?= htmlspecialchars($user['roomname']) ?></div>
            <div class="mb-2"><span class="profile-label"><i class="bi bi-person-badge me-1"></i>Room Number :</span> <?= htmlspecialchars($user['roomnumber']) ?></div>
          </div>
          <div class="col-sm-6">
            <div class="mb-2"><span class="profile-label"><img src="./image/checkin.png" width="25" height="25" alt="">Check In :</span> <?= htmlspecialchars($user['checkin']) ?></div>
            <div class="mb-2"><span class="profile-label"><img src="./image/checkout.png" width="25" height="25" alt="">Check OUt :</span> <?= htmlspecialchars($user['checkout']) ?></div>
          </div>
        </div>

      
        <div class="row g-2 mt-4">
          <div class="col-md-6">
            <a href="edit_profile.php" class="btn btn-primary w-100 fw-bold py-2">
              <i class="bi bi-pencil-square me-1"></i> แก้ไขข้อมูล
            </a>
          </div>
          <div class="col-md-6">
            <button class="btn btn-outline-secondary w-100 fw-bold py-2" onclick="showToast()">
              <i class="bi bi-share me-1"></i> แชร์โปรไฟล์
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Toast แจ้งเตือน -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="profileToast" class="toast align-items-center toast-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-check-circle me-2"></i>ลิงก์โปรไฟล์ถูกคัดลอกแล้ว!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <script>
    function showToast() {
      navigator.clipboard.writeText(window.location.href);
      var toast = new bootstrap.Toast(document.getElementById('profileToast'));
      toast.show();
    }
  </script>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
