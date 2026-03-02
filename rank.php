<?php
require("conn.php");

// Fetch personnel with their rank names using INNER JOIN to ensure we only get ranked people
$sql = "SELECT r.d_name, p.p_prefix, p.p_name, p.p_surname, p.p_id, p.p_tel 
        FROM `rank` r 
        INNER JOIN person p ON r.d_id = p.d_id 
        ORDER BY r.d_id ASC, p.p_name ASC";
$result = mysqli_query($con, $sql);
$order = 1;
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อบุคลากรแยกตามตำแหน่ง - NPRU</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f8f9fc;
        }
        .container {
            max-width: 1000px;
        }
        .page-header {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 1.5rem;
        }
        .rank-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>

<?php require("navbar.php"); ?>

<div class="container my-5">
    <div class="page-header text-center">
        <h2 class="fw-bold text-dark"><i class='bx bx-id-card me-2 text-primary'></i>รายชื่อบุคลากรแยกตามตำแหน่ง</h2>
        <p class="text-muted mb-0">ข้อมูลสรุปรายชื่อบุคลากรและสังกัดหน่วยงาน</p>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="10%">ลำดับ</th>
                        <th width="40%">ชื่อ-นามสกุล</th>
                        <th width="30%">ตำแหน่ง</th>
                        <th width="20%">เบอร์โทรศัพท์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="fw-bold text-muted"><?php echo $order++; ?></td>
                        <td>
                            <span class="fw-semibold"><?php echo $row["p_prefix"].$row["p_name"]; ?></span> <?php echo $row["p_surname"]; ?>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark rounded-pill px-3 py-2 rank-badge">
                                <?php echo $row["d_name"]; ?>
                            </span>
                        </td>
                        <td>
                            <a href="tel:<?php echo $row["p_tel"]; ?>" class="text-decoration-none">
                                <i class='bx bx-phone me-1 text-success'></i><?php echo $row["p_tel"]; ?>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-outline-secondary px-4">
                <i class='bx bx-arrow-back'></i> กลับหน้าหลัก
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


