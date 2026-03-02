<?php
require('conn.php');

// Fetch ranks for the dropdown
$sql_rank = "SELECT * FROM `rank` ORDER BY d_id ASC";
$result_rank = mysqli_query($con, $sql_rank);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก - NPRU System</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 800px;
            overflow: hidden;
            border: none;
        }
        .register-header {
            background: #4e54c8;
            background: -webkit-linear-gradient(to right, #8f94fb, #4e54c8);
            background: linear-gradient(to right, #8f94fb, #4e54c8);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 84, 200, 0.1);
            border-color: #4e54c8;
        }
        .btn-register {
            background: linear-gradient(to right, #8f94fb, #4e54c8);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 84, 200, 0.3);
        }
        .login-link {
            color: #4e54c8;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-card card">
    <div class="register-header">
        <h3 class="mb-1"><i class='bx bx-user-plus me-2'></i>สมัครสมาชิกใหม่</h3>
        <p class="mb-0 opacity-75">กรอกข้อมูลเพื่อเข้าใช้งานระบบบริหารจัดการบุคลากร</p>
    </div>
    <div class="card-body p-4 p-md-5">
        <form action="register_db.php" method="POST" enctype="multipart/form-data">
            <h5 class="mb-4 text-primary border-bottom pb-2">ข้อมูลส่วนตัว</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">คำนำหน้า</label>
                    <select name="p_prefix" class="form-select" required>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="p_name" class="form-control" placeholder="ชื่อจริง" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="p_surname" class="form-control" placeholder="นามสกุล" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">วันเดือนปีเกิด</label>
                    <input type="date" name="p_birthday" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">เบอร์โทรศัพท์</label>
                    <input type="tel" name="p_tel" class="form-control" placeholder="0XXXXXXXXX" maxlength="10" required>
                </div>
                <div class="col-12">
                    <label class="form-label">ที่อยู่ปัจจุบัน</label>
                    <textarea name="p_address" class="form-control" rows="2" placeholder="บ้านเลขที่ ตำบล อำเภอ จังหวัด..." required></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ตำแหน่ง/ฝ่าย</label>
                    <select name="d_id" class="form-select" required>
                        <option value="" disabled selected>เลือกตำแหน่ง...</option>
                        <?php while($row_rank = mysqli_fetch_array($result_rank)) { ?>
                            <option value="<?= $row_rank['d_id'] ?>"><?= $row_rank['d_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ทักษะความสามารถ</label>
                    <input type="text" name="p_skill" class="form-control" placeholder="เช่น PHP, Graphic Design">
                </div>
            </div>

            <h5 class="mb-4 mt-5 text-primary border-bottom pb-2">ข้อมูลการเข้าสู่ระบบ</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">ชื่อผู้ใช้งาน (Username)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class='bx bx-user'></i></span>
                        <input type="text" name="p_user" class="form-control border-start-0" placeholder="ใช้สำหรับ Login" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">รหัสผ่าน (Password)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class='bx bx-lock-alt'></i></span>
                        <input type="password" name="p_pass" class="form-control border-start-0" placeholder="ตั้งรหัสผ่านของคุณ" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ประเภทผู้ใช้งาน</label>
                    <select name="p_level" class="form-select" required>
                        <option value="a">ผู้ดูแลระบบ (Admin)</option>
                        <option value="u" selected>ผู้ใช้งานทั่วไป (Member)</option>
                    </select>
                    <small class="text-muted mt-1 d-block font-italic">* เลือก 'Admin' สำหรับสิทธิ์จัดการข้อมูล, 'Member' สำหรับดูข้อมูลตนเอง</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">รูปภาพประจำตัว (ตัวเลือก)</label>
                    <input type="file" name="p_image" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-primary btn-register w-100 text-white shadow">
                    <i class='bx bx-check-circle me-1'></i>ยืนยันการสมัครสมาชิก
                </button>
                <div class="text-center mt-4">
                    <span class="text-muted">มีบัญชีผู้ใช้งานอยู่แล้ว? </span>
                    <a href="login.php" class="login-link">เข้าสู่ระบบที่นี่</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
