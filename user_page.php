<?php
require("conn.php");

// Check user level
if (!isset($_SESSION["p_level"]) || $_SESSION["p_level"] != "u") {
    header("Location: login.php");
    exit();
}

$sqllogin = "SELECT p.*, r.d_name 
            FROM person p 
            LEFT JOIN `rank` r ON p.d_id = r.d_id 
            WHERE p.p_id='" . $_SESSION["p_id"] . "'";
$result = mysqli_query($con, $sqllogin);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว - NPRU Personnel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f0f2f5;
        }
        .profile-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .profile-header {
            background: linear-gradient(135deg, #620dd2 0%, #a01eff 100%);
            padding: 3rem 2rem;
            color: white;
            text-align: center;
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            margin: 0 auto 1.5rem;
            border: 4px solid rgba(255,255,255,0.3);
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }
        .info-value {
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<?php require("navbar.php"); ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="profile-card card">
                <div class="profile-header">
                    <div class="profile-avatar overflow-hidden p-0">
                        <?php if ($row["p_image"]): ?>
                            <img src="image/<?php echo $row["p_image"]; ?>" alt="Avatar" class="w-100 h-100 object-fit-cover">
                        <?php else: ?>
                            <i class='bx bx-user'></i>
                        <?php endif; ?>
                    </div>
                    <h2 class="fw-bold mb-1"><?php echo $row["p_prefix"].$row["p_name"]." ".$row["p_surname"]; ?></h2>
                    <span class="badge bg-white text-dark rounded-pill px-3 py-2">
                        <i class='bx bxs-briefcase me-1'></i> <?php echo $row["d_name"] ? $row["d_name"] : 'ยังไม่ระบุตำแหน่ง'; ?>
                    </span>
                </div>
                
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-md-6 border-end">
                            <h5 class="fw-bold mb-4 border-bottom pb-2">ข้อมูลทั่วไป</h5>
                            
                            <div class="info-label">วันเกิด</div>
                            <div class="info-value"><?php echo date('d/m/Y', strtotime($row["p_birthday"])); ?></div>
                            
                            <div class="info-label">ที่อยู่ปัจจุบัน</div>
                            <div class="info-value"><?php echo $row["p_address"]; ?></div>
                            
                            <div class="info-label">ทักษะ/ความสามารถ</div>
                            <div class="info-value">
                                <?php 
                                    $skills = explode(',', $row["p_skill"]);
                                    foreach($skills as $skill) {
                                        echo '<span class="badge bg-light text-dark border me-1">'.trim($skill).'</span>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 ps-md-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-2">ข้อมูลการติดต่อ</h5>
                            
                            <div class="info-label">เบอร์โทรศัพท์</div>
                            <div class="info-value text-primary">
                                <i class='bx bx-phone me-1'></i> <?php echo $row["p_tel"]; ?>
                            </div>
                            
                            <div class="info-label">ชื่อผู้ใช้งาน</div>
                            <div class="info-value"><?php echo $_SESSION["p_username"]; ?></div>
                            
                            <div class="mt-4 pt-2">
                                <a href="editform.php?p_id=<?php echo $row["p_id"]; ?>" class="btn btn-warning w-100 py-2 rounded-pill shadow-sm">
                                    <i class='bx bx-edit-alt'></i> แก้ไขข้อมูลส่วนตัว
                                </a>
                                <a href="logout.php" class="btn btn-outline-danger w-100 mt-2 py-2 rounded-pill">
                                    <i class='bx bx-log-out'></i> ออกจากระบบ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>