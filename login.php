<?php
session_start();
include("./connect.php");
if(isset($_SESSION["email"])){
  header("location ./");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Login Page</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Noto+Sans+Thai:wght@500;700&display=swap');

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
    .wrapper {
      width: 400px;
      border-radius: 8px;
      padding: 30px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      margin: 100px auto; /* Center the login form */
    }

    form {
      display: flex;
      flex-direction: column;
    }

    .input-field {
      position: relative;
      border-bottom: 2px solid #ccc;
      margin: 15px 0;

    }

    .input-field label {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      color: #fff;
      font-size: 16px;
      pointer-events: none;
      transition: 0.15s ease;

    }

    .input-field input {
      width: 100%;
      height: 40px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 16px;
      color: #fff;
    }

    .input-field input:focus~label,
    .input-field input:valid~label {
      font-size: 0.8rem;
      top: 10px;
      transform: translateY(-120%);
    }

    .forget {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 25px 0 35px 0;
      color: #fff;
    }
    .wrapper a {
      color: #efefef;
      text-decoration: none;
    }

    .wrapper a:hover {
      text-decoration: underline;
    }
    .register {
      text-align: center;
      margin-top: 30px;
      color: #fff;
    }

    .navbar {
      background-color:#0b2c4d; 
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000; /* Ensure it stays above other content */
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: white;
    }

    .nav-link {
      color: white;
      font-size: 1.1rem;
      margin-right: 15px;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background-color 0.3s, color 0.3s;
    }

    .nav-link:hover {
      background-color: #3a5f32; /* Darker green */
      color: #f8f9fa; /* Light color for text */
      text-decoration: none; /* Remove underline */
    }

    .nav-item {
      margin-left: 5px;
    }.password-toggle-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
      color: #333;
      transition: color 0.3s ease-in-out;
    }
    .password-toggle-icon:hover {
      color: #000;

    }
     input[type="submit"] {
      background-color: #0b2c4d; /* สีปุ่ม */
      color: #fff; /* สีตัวอักษร */
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 3px;
      transition: background-color 0.3s ease, color 0.3s ease;
      width: 100%;
      font-weight: 600;
      border: 2px solid transparent;
      transition: 0.3s ease;
    }

    input[type="submit"]:hover {
      color: #fff;
      border-color: #fff;
      background: rgba(255, 255, 255, 0.15);
      
    }.loginfont{
      font-family: "Bebas Neue", sans-serif;
      font-weight: 750;
      font-style: normal;
      color:#fff   
    }

.hotel-brand {
    font-family: 'Poppins', 'Noto Sans Thai', sans-serif;
    font-size: 1.7rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    color: #ffffff;
    text-decoration: none;
    position: relative;
    transition: all 0.35s ease;
}

/* เส้นไฮไลต์ใต้ข้อความ */
.hotel-brand::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, #38f9d7, #43e97b);
    border-radius: 5px;
    transition: width 0.35s ease;
}

.hotel-brand:hover {
    color: #FDE68A; /* สีทองอ่อน */
    text-shadow: 0 6px 15px rgba(0,0,0,0.35);
}

.hotel-brand:hover::after {
    width: 100%;
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
          <a class="nav-link" href="./contact.php">ติดต่อเรา</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            </ul>
          </div>
        </div>
      </nav>
      <br><br><br><br>
  <div class="wrapper">
    <form action="" method="POST">
      <h2 class="loginfont">Login For User</h2>
        <div class="input-field">
        <input type="text" name="email" required>
        <label>Enter your E-mail</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" id="password" required>
        <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
        <label>Enter your Password</label>
      </div><br>
      <input type="submit" name="submit" value="Log in"></input>
     

            <?php
                if(isset($_POST["submit"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
                $result = $conn->query($sql);
                if ($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["email"] = $row["email"];

                    echo' <script> 
                            alert("Login Successfully");
                            location.href="./index.php";
                        </script> ';
                
                }else{
                    echo' <script> 
                    alert("Login Fail T___T ");
                    location.href="./login.php";
                </script> ';              }

                }
            ?>
   

        <div class="register">
        <a href="./register.php">Register For User</a>
      </div>
    
   <div class="register">
        <a href="./admin/login.php">For Admin</a>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const passwordField = document.getElementById("password");
    const togglePassword = document.querySelector(".password-toggle-icon i");

    togglePassword.addEventListener("click", function () {
      if (passwordField.type === "password") {
        passwordField.type = "text";
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
      }
    });
  </script>
    </form>
  </div>
</body>
</html>





