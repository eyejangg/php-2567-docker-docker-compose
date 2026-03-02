<?php
require ("conn.php");

if (!isset($_POST["p_data"])) {
    header("location:index.php");
    exit;
}

$p_data = mysqli_real_escape_string($con, $_POST["p_data"]);
$sql = "SELECT p.*, r.d_name 
        FROM person p 
        LEFT JOIN rank r ON p.d_id = r.d_id 
        WHERE p.p_name LIKE '%$p_data%' 
        OR p.p_surname LIKE '%$p_data%' 
        ORDER BY p.p_name ASC";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
$order = 1;

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการค้นหา - ระบบบุคลากร</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table thead {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>

<?php require ("navbar.php"); ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>ผลการค้นหาบุคลากร: "<span class="text-primary"><?php echo htmlspecialchars($p_data); ?></span>"</h2>
        <a href="index.php" class="btn btn-outline-secondary">กลับหน้าหลัก</a>
    </div>

    <?php if ($count > 0) { ?>
        <div class="table-container table-responsive">
            <p class="text-muted">พบข้อมูลทั้งหมด <?php echo $count; ?> รายการ</p>
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ตำแหน่ง/ฝ่าย</th>
                        <th>วันเกิด</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ที่อยู่</th>
                        <th>ทักษะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $order++; ?></td>
                        <td>
                            <strong><?php echo $row["p_prefix"].$row["p_name"]; ?></strong> <?php echo $row["p_surname"]; ?>
                        </td>
                        <td><?php echo $row["d_name"] ? $row["d_name"] : '<span class="text-muted small">ไม่ระบุ</span>'; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row["p_birthday"])); ?></td>
                        <td><?php echo $row["p_tel"]; ?></td>
                        <td class="small text-truncate" style="max-width: 150px;"><?php echo $row["p_address"]; ?></td>
                        <td><span class="badge bg-info text-dark"><?php echo $row["p_skill"]; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning py-4 text-center">
            <h4 class="alert-heading">ไม่พบข้อมูล!</h4>
            <p>ไม่พบรายชื่อบุคลากรที่ตรงกับคำค้นหา "<?php echo htmlspecialchars($p_data); ?>"</p>
            <hr>
            <a href="index.php" class="btn btn-primary">ลองค้นหาใหม่อีกครั้ง</a>
        </div>
    <?php } ?>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


