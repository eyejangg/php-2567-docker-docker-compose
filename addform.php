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
    <title>เพิ่มข้อมูลบุคลากร</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
            text-align: center;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-submit {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card my-5">
                <div class="card-header">
                    <h3 class="mb-0">บันทึกข้อมูลบุคลากร</h3>
                </div>
                <div class="card-body p-4">
                    <form action="addupdateform.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="row g-3">
                            <!-- Profile Image -->
                            <div class="col-12 text-center mb-3">
                                <label for="p_image" class="form-label d-block text-start">รูปภาพประจำตัว (Profile Picture)</label>
                                <div class="image-preview-container border rounded-3 p-2 bg-light d-inline-block">
                                    <img id="preview" src="image/default-avatar.png" alt="Preview" style="max-height: 150px; display: block; margin: 0 auto; border-radius: 8px;">
                                </div>
                                <input type="file" name="p_image" id="p_image" class="form-control mt-2" accept="image/*" onchange="previewImage(this)">
                            </div>
                            <!-- Prefix -->
                            <div class="col-md-4">
                                <label for="p_prefix" class="form-label">คำนำหน้าชื่อ</label>
                                <select name="p_prefix" id="p_prefix" class="form-select" required>
                                    <option value="" selected disabled>เลือก...</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="col-md-8">
                                <label for="p_name" class="form-label">ชื่อ</label>
                                <input type="text" name="p_name" id="p_name" class="form-control" placeholder="ไม่ต้องใส่คำนำหน้า" required>
                            </div>

                            <!-- Surname -->
                            <div class="col-12">
                                <label for="p_surname" class="form-label">นามสกุล</label>
                                <input type="text" name="p_surname" id="p_surname" class="form-control" required>
                            </div>

                            <!-- Birthday -->
                            <div class="col-md-6">
                                <label for="p_birthday" class="form-label">วันเดือนปีเกิด</label>
                                <input type="date" name="p_birthday" id="p_birthday" class="form-control" required>
                            </div>

                            <!-- Tel -->
                            <div class="col-md-6">
                                <label for="p_tel" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="tel" name="p_tel" id="p_tel" class="form-control" maxlength="10">
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label for="p_address" class="form-label">ที่อยู่</label>
                                <textarea name="p_address" id="p_address" class="form-control" rows="2"></textarea>
                            </div>

                            <!-- Position (Rank) - Dynamic -->
                            <div class="col-12">
                                <label for="d_id" class="form-label">ตำแหน่ง/ฝ่าย</label>
                                <select name="d_id" id="d_id" class="form-select" required>
                                    <option value="" selected disabled>-- เลือกตำแหน่ง --</option>
                                    <?php while($row_rank = mysqli_fetch_array($result_rank)) { ?>
                                        <option value="<?php echo $row_rank['d_id']; ?>">
                                            <?php echo $row_rank['d_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Skill -->
                            <div class="col-12">
                                <label for="p_skill" class="form-label">ทักษะความสามารถ</label>
                                <textarea name="p_skill" id="p_skill" class="form-control" rows="2"></textarea>
                            </div>

                            <hr class="my-4">
                            <h5 class="text-primary mb-3">ข้อมูลการเข้าระบบ</h5>

                            <!-- Username -->
                            <div class="col-md-6">
                                <label for="p_user" class="form-label">ชื่อผู้ใช้งาน (Username)</label>
                                <input type="text" name="p_user" id="p_user" class="form-control" required>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <label for="p_pass" class="form-label">รหัสผ่าน (Password)</label>
                                <input type="password" name="p_pass" id="p_pass" class="form-control" required>
                            </div>

                            <!-- Level -->
                            <div class="col-12">
                                <label for="p_level" class="form-label">ระดับผู้ใช้งาน</label>
                                <select name="p_level" id="p_level" class="form-select" required>
                                    <option value="u" selected>ผู้ใช้งานทั่วไป (User)</option>
                                    <option value="a">ผู้ดูแลระบบ (Admin)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-submit flex-grow-1">บันทึกข้อมูล</button>
                            <button type="reset" class="btn btn-outline-danger" onclick="return confirm('ล้างข้อมูลทั้งหมดใช่หรือไม่?')">ล้างค่า</button>
                            <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
