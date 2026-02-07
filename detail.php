<?php
$selectedName = $_GET['name'] ?? null;
?>
<?php
    include("./connect.php");
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองห้องพัก | MeeHotel</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(11, 44, 77, 0.7), rgba(11, 44, 77, 0.7)), url('./image/1.jpeg') center/cover no-repeat fixed;
            font-family: 'Poppins', 'Noto Sans Thai', sans-serif;
            min-height: 100vh;
            color: #333;
        }
        .booking-container {
            max-width: 500px;
            margin: 60px auto 0 auto;
            background: rgba(255,255,255,0.97);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(11,44,77,0.13);
            padding: 36px 32px 28px 32px;
        }
        .hotel-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 18px;
        }
        .form-label {
            font-weight: 500;
            color: #0b2c4d;
        }
        .form-control[readonly] {
            background: #f5f6fa;
            color: #555;
        }
        .btn-book {
            background: linear-gradient(90deg, #c5a47e 0%, #0b2c4d 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 12px 0;
            font-size: 1.1rem;
            margin-top: 10px;
            transition: background 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 8px rgba(197,164,126,0.08);
        }
        .btn-book:hover {
            background: linear-gradient(90deg, #0b2c4d 0%, #c5a47e 100%);
            color: #fff;
            box-shadow: 0 4px 16px rgba(11,44,77,0.13);
        }
        .hotel-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0b2c4d;
            margin-bottom: 6px;
        }
        .hotel-loc {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 12px;
        }
        .price-tag {
            color: #c5a47e;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>

<div class="booking-container">

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



// แสดงเฉพาะโรงแรมที่เลือก
foreach ($hotels as $h) {
    if ($h['name'] === $selectedName) {
?>
        <img src="<?php echo $h['img']; ?>" class="hotel-img shadow-sm mb-3" alt="<?php echo htmlspecialchars($h['name']); ?>">
        <div class="hotel-title"><?php echo htmlspecialchars($h['name']); ?></div>
        <div class="hotel-loc"><i class="bi bi-geo-alt-fill text-danger"></i> <?php echo htmlspecialchars($h['loc']); ?></div>
        <div class="price-tag">฿<?php echo htmlspecialchars($h['price']); ?> / คืน</div>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">ชื่อห้องพัก</label>
                <input type="text" name="roomname" class="form-control" value="<?php echo htmlspecialchars($h['name']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">หมายเลขห้อง</label>
                <input type="text" name="roomnumber" class="form-control" value="<?php echo htmlspecialchars($h['roomnumber']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">วันที่เช็คอิน</label>
                <input type="date" name="checkin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">วันที่เช็คเอาท์</label>
                <input type="date" name="checkout" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ราคา (ต่อคืน)</label>
                <input type="text" name="price" class="form-control" value="<?php echo htmlspecialchars($h['price']); ?>" readonly>
            </div>
            <button type="submit"  name="submit" class="btn btn-book w-100"><i class="bi bi-calendar2-check-fill me-2"></i>ยืนยันการจอง</button>
       
        <?php

if (isset($_POST["submit"])) {

    $id    = $_SESSION['id']; // id ของ user
    $roomname   = $_POST["roomname"];
    $roomnumber = $_POST["roomnumber"];
    $checkin    = $_POST["checkin"];
    $checkout   = $_POST["checkout"];
    $price      = $_POST["price"];

    $sql = "UPDATE users SET
                roomname   = ?,
                roomnumber = ?,
                checkin    = ?,
                checkout   = ?,
                price      = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssii",
        $roomname,
        $roomnumber,
        $checkin,
        $checkout,
        $price,
        $id
    );

    if ($stmt->execute()) {
        echo "<script>
            alert('บันทึกข้อมูลเรียบร้อย');
            location.href='./index.php';
        </script>";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล";
    }
}
?>


  
          </form>
<?php
        break;
    }
}
?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
