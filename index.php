<?php
require("conn.php");

// Fetch personnel with their rank names using LEFT JOIN
$sql = "SELECT p.*, r.d_name 
        FROM person p 
        LEFT JOIN `rank` r ON p.d_id = r.d_id 
        ORDER BY p.p_name ASC";
$result = mysqli_query($con, $sql);
$order = 1;
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบบริหารจัดการบุคลากร NPRU</title>
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
        .main-content {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .page-header {
            margin-bottom: 2rem;
            border-left: 5px solid #0d6efd;
            padding-left: 1rem;
        }
        .table-card {
            background: white;
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .table thead {
            background-color: #f8f9fa;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-top: none;
        }
        .person-name {
            font-weight: 600;
            color: #333;
        }
        .badge-position {
            font-weight: 400;
            font-size: 0.85rem;
        }
        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
            margin: 0 2px;
        }
        .action-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<?php require("navbar.php"); ?>

<main class="main-content container">
    <div class="row align-items-end mb-4">
        <div class="col-md-6">
            <div class="page-header">
                <h2 class="fw-bold mb-0">รายชื่อบุคลากร</h2>
                <p class="text-muted mb-0">จัดการข้อมูลบุคลากรในมหาวิทยาลัย</p>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="addform.php" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                <i class='bx bx-plus-circle me-1'></i> เพิ่มบุคลากรใหม่
            </a>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ลำดับ</th>
                        <th>ข้อมูลบุคลากร</th>
                        <th>ตำแหน่ง/ฝ่าย</th>
                        <th>ติดต่อ</th>
                        <th>วันเกิด</th>
                        <th class="text-center pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="ps-4 text-muted"><?php echo $order++; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle overflow-hidden p-0 me-3 d-none d-sm-block" style="width: 48px; height: 48px;">
                                    <?php if ($row["p_image"]): ?>
                                        <img src="image/<?php echo $row["p_image"]; ?>" alt="Avatar" class="w-100 h-100 object-fit-cover">
                                    <?php else: ?>
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary">
                                            <i class='bx bx-user fs-4'></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="person-name"><?php echo $row["p_prefix"].$row["p_name"]." ".$row["p_surname"]; ?></div>
                                    <div class="small text-muted"><i class='bx bx-map-pin me-1'></i><?php echo $row["p_address"]; ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-primary text-primary border border-primary-subtle badge-position px-3 py-2 rounded-pill">
                                <?php echo $row["d_name"] ? $row["d_name"] : 'ไม่ระบุ'; ?>
                            </span>
                        </td>
                        <td>
                            <div class="small"><i class='bx bx-phone me-1 text-success'></i><?php echo $row["p_tel"]; ?></div>
                        </td>
                        <td class="small">
                            <?php echo date('d/m/Y', strtotime($row["p_birthday"])); ?>
                        </td>
                        <td class="text-center pe-4">
                            <a href="editform.php?p_id=<?php echo $row['p_id']; ?>" class="action-btn btn btn-outline-warning" title="แก้ไข">
                                <i class='bx bx-edit-alt'></i>
                            </a>
                            <a href="deleteform.php?p_id=<?php echo $row['p_id']; ?>" class="action-btn btn btn-outline-danger" title="ลบ" onclick="return confirm('ยืนยันการลบข้อมูลของ <?php echo $row['p_name']; ?> ใช่หรือไม่?')">
                                <i class='bx bx-trash'></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

