<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking2";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว");
}

/* ====== เมื่อกด submit ====== */
if (isset($_POST['submit'])) {

    $name     = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email    = $_POST['email'];
    $address  = $_POST['address'];
    $phone    = $_POST['phone'];

    $sql = "INSERT INTO users 
            (name, lastname, username, password, email, address, phone)
            VALUES 
            ('$name', '$lastname', '$username', '$password', '$email', '$address', '$phone')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('เพิ่มข้อมูลสำเร็จ');
            window.location='user.php';
        </script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มผู้ใช้</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            เพิ่มข้อมูลผู้ใช้
        </div>
        <div class="card-body">
            <form method="post">

                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">อีเมล</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ที่อยู่</label>
                    <input type="text" name="address" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success w-100">
                    บันทึกข้อมูล
                </button>

            </form>
        </div>
    </div>
</div>

</body>
</html>
