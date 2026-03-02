<?php
require('conn.php');

if (!isset($_GET["p_id"])) {
    header("location:index.php");
    exit;
}

$p_id = $_GET["p_id"];

// Fetch person data
$sql_select = "SELECT * FROM person WHERE p_id = $p_id";
$result = mysqli_query($con, $sql_select);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "ไม่พบข้อมูลบุคลากร";
    exit;
}

// Fetch ranks for the dropdown
$sql_rank = "SELECT * FROM `rank` ORDER BY d_id ASC";
$result_rank = mysqli_query($con, $sql_rank);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลบุคลากร</title>
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
            background: rgba(255, 255, 255, 0.95);
        }
        .card-header {
            background-color: #198754; /* Success color for Edit */
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
            text-align: center;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-update {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card my-5">
                <div class="card-header">
                    <h3 class="mb-0">แก้ไขข้อมูลบุคลากร</h3>
                </div>
                <div class="card-body p-4">
                    <form action="editupdate.php" method="POST">
                        <input type="hidden" name="p_id" value="<?php echo $row["p_id"]; ?>">
                        
                        <div class="row g-3">
                            <!-- Prefix -->
                            <div class="col-md-4">
                                <label for="p_prefix" class="form-label">คำนำหน้าชื่อ</label>
                                <select name="p_prefix" id="p_prefix" class="form-select" required>
                                    <option value="นาย" <?php if($row["p_prefix"]=="นาย") echo "selected"; ?>>นาย</option>
                                    <option value="นาง" <?php if($row["p_prefix"]=="นาง") echo "selected"; ?>>นาง</option>
                                    <option value="นางสาว" <?php if($row["p_prefix"]=="นางสาว") echo "selected"; ?>>นางสาว</option>
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="col-md-8">
                                <label for="p_name" class="form-label">ชื่อ</label>
                                <input type="text" name="p_name" id="p_name" class="form-control" value="<?php echo $row["p_name"]; ?>" required>
                            </div>

                            <!-- Surname -->
                            <div class="col-12">
                                <label for="p_surname" class="form-label">นามสกุล</label>
                                <input type="text" name="p_surname" id="p_surname" class="form-control" value="<?php echo $row["p_surname"]; ?>" required>
                            </div>

                            <!-- Birthday -->
                            <div class="col-md-6">
                                <label for="p_birthday" class="form-label">วันเดือนปีเกิด</label>
                                <input type="date" name="p_birthday" id="p_birthday" class="form-control" value="<?php echo $row["p_birthday"]; ?>" required>
                            </div>

                            <!-- Tel -->
                            <div class="col-md-6">
                                <label for="p_tel" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="tel" name="p_tel" id="p_tel" class="form-control" value="<?php echo $row["p_tel"]; ?>" maxlength="10">
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label for="p_address" class="form-label">ที่อยู่</label>
                                <textarea name="p_address" id="p_address" class="form-control" rows="2"><?php echo $row["p_address"]; ?></textarea>
                            </div>

                            <!-- Position (Rank) - Dynamic -->
                            <div class="col-12">
                                <label for="d_id" class="form-label">ตำแหน่ง/ฝ่าย</label>
                                <select name="d_id" id="d_id" class="form-select" required>
                                    <option value="" disabled>-- เลือกตำแหน่ง --</option>
                                    <?php while($row_rank = mysqli_fetch_array($result_rank)) { ?>
                                        <option value="<?php echo $row_rank['d_id']; ?>" <?php if($row["d_id"]==$row_rank['d_id']) echo "selected"; ?>>
                                            <?php echo $row_rank['d_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Skill -->
                            <div class="col-12">
                                <label for="p_skill" class="form-label">ทักษะความสามารถ</label>
                                <textarea name="p_skill" id="p_skill" class="form-control" rows="2"><?php echo $row["p_skill"]; ?></textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-update flex-grow-1">บันทึกการแก้ไข</button>
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
</body>
</html>
