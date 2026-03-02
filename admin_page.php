<?php
require("conn.php");

// Check privileges
if (!isset($_SESSION["p_level"]) || $_SESSION["p_level"] != "a") {
    header("Location: login.php");
    exit();
}

// Fetch totals for dashboard stats
$sql_count = "SELECT COUNT(*) as total FROM person";
$res_count = mysqli_query($con, $sql_count);
$row_count = mysqli_fetch_assoc($res_count);

$sql_rank_count = "SELECT COUNT(*) as total FROM `rank`";
$res_rank_count = mysqli_query($con, $sql_rank_count);
$row_rank_count = mysqli_fetch_assoc($res_rank_count);

// Fetch personnel
$sql = "SELECT p.*, r.d_name 
        FROM person p 
        LEFT JOIN `rank` r ON p.d_id = r.d_id 
        ORDER BY p.p_id DESC";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่วนผู้ดูแลระบบ (Admin) - NPRU Personnel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f4f7fe;
        }
        .admin-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .admin-card:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
    </style>
</head>
<body>

<?php require("navbar.php"); ?>

<div class="container my-5">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm">
                <div>
                    <h2 class="fw-bold text-dark mb-1">ยินดีต้อนรับ, แอดมิน!</h2>
                    <p class="text-muted mb-0">จัดการระบบและข้อมูลบุคลากรทั้งหมดได้ที่นี่</p>
                </div>
                <div class="text-end">
                    <a href="logout.php" class="btn btn-outline-danger px-4 rounded-pill">
                        <i class='bx bx-log-out'></i> ออกจากระบบ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="admin-card card p-4">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                        <i class='bx bxs-user-detail'></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">บุคลากรทั้งหมด</h6>
                        <h3 class="fw-bold mb-0"><?php echo $row_count['total']; ?> คน</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-card card p-4">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                        <i class='bx bxs-briefcase'></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">จำนวนตำแหน่ง/ฝ่าย</h6>
                        <h3 class="fw-bold mb-0"><?php echo $row_rank_count['total']; ?> ตำแหน่ง</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
            <a href="addform.php" class="btn btn-primary btn-lg w-100 py-3 rounded-4 shadow">
                <i class='bx bx-plus-circle'></i> เพิ่มบุคลากรใหม่
            </a>
        </div>
    </div>

    <!-- Personnel Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold mb-0"><i class='bx bx-table me-2'></i>ตารางคัดกรองบุคลากร</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ชื่อ-นามสกุล</th>
                        <th>ตำแหน่ง</th>
                        <th>ติดต่อ</th>
                        <th>วันเกิด</th>
                        <th class="text-center pe-4">การจัดการสิทธิ์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle overflow-hidden p-0 me-2" style="width: 32px; height: 32px;">
                                    <?php if ($row["p_image"]): ?>
                                        <img src="image/<?php echo $row["p_image"]; ?>" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                    <?php else: ?>
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary">
                                            <i class='bx bx-user fs-6'></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="fw-bold text-primary"><?php echo $row["p_prefix"].$row["p_name"]; ?></div>
                                    <div class="small text-muted"><?php echo $row["p_surname"]; ?></div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary rounded-pill fw-normal"><?php echo $row["d_name"]; ?></span></td>
                        <td class="small"><?php echo $row["p_tel"]; ?></td>
                        <td class="small"><?php echo date('d/m/Y', strtotime($row["p_birthday"])); ?></td>
                        <td class="text-center pe-4">
                            <div class="btn-group">
                                <a href="editform.php?p_id=<?php echo $row["p_id"]; ?>" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                <a href="deleteform.php?p_id=<?php echo $row["p_id"]; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('ยืนยันการลบข้อมูลของ <?php echo $row['p_name']; ?>?')">ลบ</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
