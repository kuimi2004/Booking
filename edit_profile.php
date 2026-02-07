<?php
session_start();

$conn = new mysqli("localhost", "root", "", "booking2");
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว");
}

if (!isset($_SESSION['id'])) {
    die("ไม่พบ id user ใน session");
}
$id = $_SESSION['id'];

/* ================= UPDATE ================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name      = $_POST['name'];
    $lastname  = $_POST['lastname'];
    $username  = $_POST['username'];
    $email     = $_POST['email'];
    $address   = $_POST['address'];
    $phone     = $_POST['phone'];

    // ถ้ามีการกรอกรหัสผ่านใหม่
    if (!empty($_POST['password'])) {

        $password = $_POST['password'] ;

        $sql = "UPDATE users 
                SET name=?, lastname=?, username=?, password=?, email=?, address=?, phone=?
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssi",
            $name, $lastname, $username, $password,
            $email, $address, $phone, $id
        );

    } else {

        // ไม่เปลี่ยนรหัสผ่าน
        $sql = "UPDATE users 
                SET name=?, lastname=?, username=?, email=?, address=?, phone=?
                WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssi",
            $name, $lastname, $username,
            $email, $address, $phone, $id
        );
    }

    if ($stmt->execute()) {
        echo "<script>
            alert('Update Successfully');
            window.location='profile.php';
        </script>";
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }
}

/* ================= SELECT ================= */
$sql = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$users = $stmt->get_result()->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <style>
        /* เพิ่ม CSS styles ของคุณที่นี่ */
        .button-65 {
            appearance: none;
            backface-visibility: hidden;
            background-color: #2f80ed;
            border-radius: 10px;
            border-style: none;
            box-shadow: none;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: Inter,-apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif;
            font-size: 15px;
            font-weight: 500;
            height: 50px;
            letter-spacing: normal;
            line-height: 1.5;
            outline: none;
            overflow: hidden;
            padding: 14px 30px;
            position: relative;
            text-align: center;
            text-decoration: none;
            transform: translate3d(0, 0, 0);
            transition: all .3s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: top;
            white-space: nowrap;
        }

        .button-65:hover {
            background-color: #1366d6;
            box-shadow: rgba(0, 0, 0, .05) 0 5px 30px, rgba(0, 0, 0, .05) 0 1px 4px;
            opacity: 1;
            transform: translateY(0);
            transition-duration: .35s;
        }

        .button-65:active {
            box-shadow: rgba(0, 0, 0, .1) 0 3px 6px 0, rgba(0, 0, 0, .1) 0 0 10px 0, rgba(0, 0, 0, .1) 0 1px 4px -1px;
            transform: translateY(2px);
            transition-duration: .35s;
        }
    </style>
</head>
<body>

<br><br><br>
<div class="container">
    <div class="row gy-4 gy-lg-0">
        
        <div class="col-12 col-lg-8 col-xl-9">
            <div class="card border-light shadow-sm">
                <div class="card-header text-bg-primary">Profile Information</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($users['name']); ?>">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($users['lastname']); ?>">
                            </div>



                              <div class="col-lg-6 mb-3">
                                <label for="lastname" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($users['username']); ?>">
                            </div>


                    <div class="col-lg-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" value="">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                Show
                            </button>
                        </div>
                    </div>


                            <div class="col-lg-6 mb-3">
                                <label for="address" class="form-label">E-Mail</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($users['email']); ?>">
                            </div>
                         

                        <div class="col-lg-6 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($users['address']); ?>">
                            </div>

                           <div class="col-lg-6 mb-3">
                                <label for="address" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($users['phone']); ?>">
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="button-65">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<script>
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePasswordButton.addEventListener('click', function () {
        // Toggle input type
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle button text
        this.textContent = type === 'password' ? 'Show' : 'Hide';
    });
</script>

              
</body>
</html>
