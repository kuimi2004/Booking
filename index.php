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

<!-- HERO HEADER -->
<header class="hero-section fade-in">
    <div class="container">
        <h1 class="hero-title">ยินดีต้อนรับสู่ มีโฮเทล</h1>
        <p class="hero-subtitle">สัมผัสประสบการณ์การพักผ่อนที่เหนือระดับ กับห้องพักสุดหรูและบริการที่คุณจะประทับใจ</p>
    </div>
</header>

<!-- MAIN CONTENT -->
<div class="container pb-5">
    
    <!-- Filter/Search Bar (Optional Visual) -->
    <div class="row justify-content-center mb-5 fade-in" style="animation-delay: 0.2s;">
        <div class="col-lg-10">
            <div class="bg-white p-4 rounded-4 shadow-sm d-flex flex-wrap gap-3 align-items-end justify-content-between">
                <div class="flex-grow-1">
                    <label class="form-label text-muted small fw-bold">ค้นหาโรงแรม</label>
                    <input type="text" class="form-control border-0 bg-light" placeholder="ชื่อโรงแรม หรือ สถานที่...">
                </div>
                <button class="btn btn-primary px-4 py-2" style="background: var(--primary-color);">
                    <i class="bi bi-search me-2"></i> ค้นหา
                </button>
            </div>
        </div>
    </div>

    <!-- HOTEL GRID -->
    <div class="row g-4 justify-content-center">
    
    <?php
    
    $hotels = [
    ["name" => "Udai Niwas", "roomnumber" => "201", "loc" => "Rajasthan, India", "price" => "1684", "img" => "./image/photo1.png"],
    ["name" => "Love Palace", "roomnumber" => "202", "loc" => "Udaipur, India", "price" => "3000", "img" => "./image/photo2.png"],
    ["name" => "Hotel Barva", "roomnumber" => "203", "loc" => "Mumbai, India", "price" => "4000", "img" => "./image/photo3.png"],
    ["name" => "Royal Orchid", "roomnumber" => "204", "loc" => "Pune, India", "price" => "5500", "img" => "./image/photo4.png"],
    ["name" => "Golden Sands", "roomnumber" => "205", "loc" => "Goa, India", "price" => "3200", "img" => "./image/photo5.png"],
    ["name" => "Azure Bay", "roomnumber" => "206", "loc" => "Phuket, Thailand", "price" => "4500", "img" => "./image/photo6.png"],
    ["name" => "Mountain View", "roomnumber" => "207", "loc" => "Chiang Mai, Thailand", "price" => "2800", "img" => "./image/photo7.png"],
    ["name" => "City Center", "roomnumber" => "208", "loc" => "Bangkok, Thailand", "price" => "3500", "img" => "./image/photo8.png"],
];

    $delay = 0.3;
    foreach($hotels as $h) {
    ?>
        <div class="col-xl-3 col-lg-4 col-md-6 fade-in" style="animation-delay: <?php echo $delay; ?>s;">
            <div class="card hotel-card">
                <div class="card-img-wrapper">
                    <span class="card-badge">แนะนำ</span>
                    <img src="<?php echo $h['img']; ?>" alt="Hotel Image">
                </div>
                <div class="card-body">
                    <h6 class="hotel-name"><?php echo $h['name']; ?></h6>
                    <div class="location">
                        <i class="bi bi-geo-alt-fill text-danger"></i> <?php echo $h['loc']; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div class="flex-grow-1">
                            <span class="price-sub">เริ่มต้น</span>
                            <div class="price-tag">฿<?php echo $h['price']; ?></div>
                        </div>
                        <div class="d-grid w-100 ms-3">
                            <a href="./detail.php?name=<?php echo $h['name']; ?>" class="btn btn-view btn-sm stylish-book-btn w-100">
                                <i class="bi bi-calendar2-check-fill me-2"></i>จอง <?php echo $h['name']; ?> ตอนนี้
                            </a>
                        </div>

 
                    </div>
                </div>
            </div>
        </div>
    <?php 
        $delay += 0.1;
    } 
    ?>

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
