<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(120deg, #667eea, #764ba2, #89f7fe);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 35px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
            color: #fff;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .login-card h3 {
            font-weight: 600;
        }

        .form-control {
            border-radius: 12px;
            padding-left: 40px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #fff;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: #fff;
            position: absolute;
            z-index: 5;
            margin-top: 6px;
            margin-left: 10px;
        }

        .btn-login {
            border-radius: 12px;
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            border: none;
            font-weight: bold;
            color: #000;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }
        .footer-text {
            font-size: 0.85rem;
            opacity: 0.8;
        }
         .admin-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 22px;
    margin-top: 10px;
    text-decoration: none;
    color: #ffffff;
    font-size: 0.9rem;
    font-weight: 500;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(8px);
    transition: all 0.3s ease;
}

.admin-link:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-1px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    color: #fff;
}.password-wrapper {
    position: relative;
}

.password-wrapper .form-control {
    border-radius: 12px;
    padding-left: 45px;   /* เว้นที่ให้ไอคอนล็อก */
    padding-right: 45px;  /* เว้นที่ให้ไอคอนตา */
}

.password-wrapper .icon-left {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #fff;
    opacity: 0.9;
    pointer-events: none;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #fff;
    opacity: 0.8;
    z-index: 5;
}

.toggle-password:hover {
    opacity: 1;
}

    </style>
</head>
<body>

<div class="login-card">
    <h3 class="text-center mb-4">🔐 เข้าสู่ระบบ</h3>

    <form id="loginForm">
        <div class="mb-3 position-relative">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" id="username" class="form-control" placeholder="ชื่อผู้ใช้">
        </div>

 <div class="mb-4 password-wrapper">
    <!-- ไอคอนแม่กุญแจ -->
    <i class="bi bi-lock-fill icon-left"></i>

    <!-- ช่องรหัสผ่าน -->
    <input type="password" id="password" class="form-control" placeholder="รหัสผ่าน">

    <!-- ไอคอนตา -->
    <i class="bi bi-eye-fill toggle-password" onclick="togglePassword()"></i>
</div>




        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-login py-2">Login</button>
        </div>
    </form>

<center class="mt-2">
    <a href="./admin/login.php" class="admin-link">
        <i class="bi bi-shield-lock-fill"></i> Admin
    </a>
</center>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
    } else {
        passwordInput.type = "password";
        icon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    }
}
</script>



</body>
</html>
