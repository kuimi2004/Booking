<?php
$conn = new mysqli("localhost", "root", "", "booking2");

if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว");
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);








$search = "";
if (isset($_GET['search']) && $_GET['search'] !== "") {
    $search = $_GET['search'];

    // ค้นหา username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ?");
    $keyword = "%" . $search . "%";
    $stmt->bind_param("s", $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    // แสดงทั้งหมด
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
}
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

/* ===== CONTENT =====  ระยะห่างข้างบนนาฟบาร์เเละคอนเมชทนเนอร์ */
.page-space{
    padding-top:200px; 
}

/* ===== WELCOME CARD ===== */
.admin-card{
    max-width:1500px; /*ควาใมกว้างของคอนเทนเนอร์*/
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
}.button-40 {
  background-color:  #e3e83b;
  border: 1px solid transparent;
  border-radius: .75rem;
  box-sizing: border-box;
  color: #000000;
  cursor: pointer;
  flex: 0 0 auto;
  font-family: "Inter var",ui-sans-serif,system-ui,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  font-size: 1.125rem;
  font-weight: 600;
  line-height: 1.5rem;
  padding: .75rem 1.2rem;
  text-align: center;
  text-decoration: none #6B7280 solid;
  text-decoration-thickness: auto;
  transition-duration: .2s;
  transition-property: background-color,border-color,color,fill,stroke;
  transition-timing-function: cubic-bezier(.4, 0, 0.2, 1);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: auto;
}

.button-40:hover {
  background-color: #c2c7cf;
}

.button-40:focus {
  box-shadow: none;
  outline: 2px solid transparent;
  outline-offset: 2px;
}

@media (min-width: 768px) {
  .button-40 {
    padding: .75rem 1.5rem;
  }
}/* ===== SEARCH USERNAME ===== */
.search-wrapper{
    max-width:480px;
    margin-left:auto; /* ดันไปขวา */
}


.search-box{
    background:rgba(255,255,255,.95);
    border-radius:40px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.35);
}

.search-icon{
    background:transparent;
    border:none;
    padding-left:20px;
    color:#0b2c4d;
    font-size:1.2rem;
}

.search-input{
    border:none;
    box-shadow:none;
    font-size:1rem;
    padding:14px 10px;
}

.search-input:focus{
    box-shadow:none;
}

.search-btn{
    background:linear-gradient(135deg,#38f9d7,#43e97b);
    border:none;
    color:#0b2c4d;
    font-weight:600;
    padding:0 28px;
    border-radius:0 40px 40px 0;
    transition:.3s;
}

.search-btn:hover{
    background:linear-gradient(135deg,#43e97b,#38f9d7);
    color:#000;
}











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
    <div class="bg-warning text-dark fw-bold py-2 px-4 position-absolute top-0 start-50 translate-middle-x rounded-bottom shadow" style="font-size:1.1rem;letter-spacing:1px;z-index:2;box-shadow:0 2px 8px #c5a47e80;max-width:300px;">
        <i class="bi bi-shield-lock-fill me-1"></i> ADMIN PANEL
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h3 class="mb-0" style="color:#fff;font-weight:700;letter-spacing:1px;"><i class="bi bi-people-fill me-2"></i>จัดการผู้ใช้ระบบ</h3>
        <a href="./add_user.php" class="btn btn-warning text-dark fw-bold shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> เพิ่มผู้ใช้
        </a>
    </div>



 <!-- ฟอร์มค้นหา -->
      <!-- SEARCH USERNAME -->
<div class="d-flex mb-4">
    <div class="search-wrapper ms-auto">
        <form method="get">
            <div class="search-box input-group">
                <span class="input-group-text search-icon">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text"
                       name="search"
                       class="form-control search-input"
                       placeholder="ค้นหา username ผู้ใช้..."
                       value="<?= htmlspecialchars($search) ?>">
                <button class="btn search-btn" type="submit">
                    ค้นหา
                </button>
            </div>
        </form>
    </div>
</div>



<div class="container mt-5">
    <h4 class="mb-4 text-primary fw-bold"><i class="bi bi-list-ul me-2"></i> รายชื่อผู้ใช้ทั้งหมด</h4>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center shadow-sm rounded-3 overflow-hidden">
            <thead class="table-warning text-dark">
                <tr>
                    <th>#</th>
                    <th><i class="bi bi-person-fill"></i> ชื่อ</th>
                    <th><i class="bi bi-person-badge"></i> นามสกุล</th>
                    <th><i class="bi bi-person-lines-fill"></i> Username</th>
                    <th><i class="bi bi-envelope-fill"></i> Email</th>
                    <th><i class="bi bi-telephone-fill"></i> เบอร์โทร</th>
                    <th><i class="bi bi-gear"></i> จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="fw-bold text-primary">#<?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['lastname']); ?></td>
                            <td><?= htmlspecialchars($row['username']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $row['id']; ?>" class="btn btn-outline-warning btn-sm me-1" title="แก้ไข">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="delete_user.php?id=<?= $row['id']; ?>" 
                                   class="btn btn-outline-danger btn-sm" title="ลบ"
                                   onclick="return confirm('ยืนยันการลบผู้ใช้?')">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-muted">ไม่มีข้อมูลผู้ใช้</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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







