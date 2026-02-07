<?php
session_start();
// ตัวอย่างข้อมูลผู้ใช้และสถิติ (สามารถเชื่อมต่อฐานข้อมูลจริงได้)
$user = [
    'name' => 'Guest',
    'role' => 'ผู้ใช้งานทั่วไป',
];

$stats = [
    'total_bookings' => 12,
    'upcoming' => 3,
    'cancelled' => 1,
    'hotels' => 8,
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | MeeHotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(11, 44, 77, 0.7), rgba(11, 44, 77, 0.7)), url('./image/1.jpeg') center/cover no-repeat fixed;
            font-family: 'Poppins', 'Noto Sans Thai', sans-serif;
            min-height: 100vh;
            color: #333;
        }
        .dashboard-container {
            max-width: 900px;
            margin: 60px auto 0 auto;
            background: rgba(255,255,255,0.97);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(11,44,77,0.13);
            padding: 36px 32px 28px 32px;
        }
        .dashboard-title {
            font-size: 2rem;
            font-weight: 700;
            color: #0b2c4d;
            margin-bottom: 18px;
        }
        .stat-card {
            background: #f8f9fa;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(11,44,77,0.06);
            padding: 24px 18px;
            text-align: center;
            margin-bottom: 18px;
        }
        .stat-icon {
            font-size: 2.2rem;
            color: #c5a47e;
            margin-bottom: 8px;
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0b2c4d;
        }
        .stat-label {
            color: #6c757d;
            font-size: 1rem;
        }
        .welcome-box {
            background: linear-gradient(90deg, #c5a47e 0%, #0b2c4d 100%);
            color: #fff;
            border-radius: 12px;
            padding: 24px 18px;
            margin-bottom: 28px;
            box-shadow: 0 2px 8px rgba(197,164,126,0.08);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="welcome-box mb-4">
            <h2 class="mb-1">สวัสดี, <?php echo htmlspecialchars($user['name']); ?>!</h2>
            <div>สถานะ: <?php echo htmlspecialchars($user['role']); ?></div>
        </div>
        <div class="dashboard-title mb-4"><i class="bi bi-speedometer2 me-2"></i>แดชบอร์ดภาพรวม</div>
        <div class="row g-4 mb-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
                    <div class="stat-value"><?php echo $stats['total_bookings']; ?></div>
                    <div class="stat-label">การจองทั้งหมด</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
                    <div class="stat-value"><?php echo $stats['upcoming']; ?></div>
                    <div class="stat-label">รอเข้าพัก</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-x-circle"></i></div>
                    <div class="stat-value"><?php echo $stats['cancelled']; ?></div>
                    <div class="stat-label">ยกเลิก</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-building"></i></div>
                    <div class="stat-value"><?php echo $stats['hotels']; ?></div>
                    <div class="stat-label">โรงแรมในระบบ</div>
                </div>
            </div>
        </div>
        <div class="text-end">
            <a href="index.php" class="btn btn-primary" style="background: #0b2c4d; border:none;">กลับหน้าหลัก</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
