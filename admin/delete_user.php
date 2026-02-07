<?php
$conn = new mysqli("localhost", "root", "", "booking2");
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว");
}

// ตรวจสอบว่ามี id ส่งมาหรือไม่
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Prepared Statement
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('ลบข้อมูลสำเร็จ');
            window.location='user.php';
        </script>";
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล";
    }

} else {
    echo "ไม่พบข้อมูลที่ต้องการลบ";
}
?>
