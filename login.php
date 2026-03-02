<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - ระบบบริหารจัดการบุคลากร</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header i {
            font-size: 60px;
            color: #764ba2;
            margin-bottom: 10px;
        }
        .login-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(118, 75, 162, 0.25);
            border-color: #764ba2;
        }
        .btn-login {
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            opacity: 0.9;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            color: #764ba2;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <i class='bx bxs-user-circle'></i>
        <h2>เข้าสู่ระบบบุคลากร</h2>
        <p class="text-muted small">กรุณาเข้าสู่ระบบเพื่อจัดการข้อมูล</p>
    </div>

    <form method="POST" action="check.php">
        <div class="mb-3">
            <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class='bx bxs-user'></i></span>
                <input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Username" required>
            </div>
        </div>
        
        <div class="mb-4">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class='bx bxs-lock-alt'></i></span>
                <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-login">เข้าสู่ระบบ</button>
        
        <div class="text-center mt-3">
            <span class="text-muted small">ยังไม่มีบัญชี? </span>
            <a href="register.php" class="login-link small fw-bold text-decoration-none" style="color: #764ba2;">สมัครสมาชิกใหม่</a>
        </div>

        <a href="index.php" class="back-link">
            <i class='bx bx-arrow-back'></i> กลับหน้าหลัก
        </a>
    </form>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
