<?php
$conn = new mysqli("localhost", "root", "", "booking2");
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว");
}

// ====== รับ id ======
if (!isset($_GET['id'])) {
    die("ไม่พบข้อมูลผู้ใช้");
}
$id = (int)$_GET['id'];

// ====== อัปเดตข้อมูล ======
if (isset($_POST['update'])) {

    $name     = $_POST['name'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];

    // ถ้ากรอกรหัสผ่านใหม่
    if (!empty($_POST['password'])) {

        $password = $_POST['password']; // แนะนำ: ควร hash ในระบบจริง

        $sql = "UPDATE users 
                SET name=?, lastname=?, username=?, password=?, email=?, phone=?
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssi",
            $name, $lastname, $username, $password, $email, $phone, $id
        );

    } else {
        // ไม่เปลี่ยนรหัสผ่าน
        $sql = "UPDATE users 
                SET name=?, lastname=?, username=?, email=?, phone=?
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssi",
            $name, $lastname, $username, $email, $phone, $id
        );
    }

    if ($stmt->execute()) {
        echo "<script>
            alert('อัปเดตข้อมูลสำเร็จ');
            window.location='user.php';
        </script>";
        exit;
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
    }
}

// ====== ดึงข้อมูลเดิม ======
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("ไม่พบข้อมูลผู้ใช้");
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แก้ไขผู้ใช้</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            แก้ไขข้อมูลผู้ใช้
        </div>
        <div class="card-body">

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="name" class="form-control"
                           value="<?= htmlspecialchars($user['name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="lastname" class="form-control"
                           value="<?= htmlspecialchars($user['lastname']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control"
                           value="<?= htmlspecialchars($user['username']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        รหัสผ่านใหม่ <small class="text-muted">(เว้นว่างหากไม่เปลี่ยน)</small>
                    </label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">เบอร์โทร</label>
                    <input type="text" name="phone" class="form-control"
                           value="<?= htmlspecialchars($user['phone']); ?>" required>
                </div>

                <button type="submit" name="update" class="btn btn-warning w-100">
                    อัปเดตข้อมูล
                </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>
