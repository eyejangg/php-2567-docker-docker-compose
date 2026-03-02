<?php
require('conn.php');

// Receive data from register.php
$p_prefix = mysqli_real_escape_string($con, $_POST["p_prefix"]);
$p_name = mysqli_real_escape_string($con, $_POST["p_name"]);
$p_surname = mysqli_real_escape_string($con, $_POST["p_surname"]);
$p_birthday = mysqli_real_escape_string($con, $_POST["p_birthday"]);
$p_address = mysqli_real_escape_string($con, $_POST["p_address"]);
$p_skill = mysqli_real_escape_string($con, $_POST["p_skill"]);
$p_tel = mysqli_real_escape_string($con, $_POST["p_tel"]);
$d_id = (int)$_POST["d_id"];

// Login data
$p_user = mysqli_real_escape_string($con, $_POST["p_user"]);
$p_pass = md5($_POST["p_pass"]);
$p_level = mysqli_real_escape_string($con, $_POST["p_level"]);

// Handle Image Upload (Optional)
$p_image = "";
if (isset($_FILES['p_image']) && $_FILES['p_image']['error'] == 0) {
    if ($_FILES['p_image']['size'] > 0) {
        $target_dir = "image/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_ext = strtolower(pathinfo($_FILES["p_image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid('reg_', true) . '.' . $file_ext;
        $target_file = $target_dir . $new_filename;
        
        $check = getimagesize($_FILES["p_image"]["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) {
                $p_image = $new_filename;
            }
        }
    }
}

// Check if username already exists
$check_user = "SELECT p_user FROM person WHERE p_user = '$p_user'";
$result_check = mysqli_query($con, $check_user);

if (mysqli_num_rows($result_check) > 0) {
    echo "<script>
        alert('มีชื่อผู้ใช้งานนี้ในระบบแล้ว กรุณาใช้ชื่ออื่น');
        window.history.back();
    </script>";
    exit();
}

// Insert data into person table
$sql = "INSERT INTO person (p_prefix, p_name, p_surname, p_birthday, p_address, p_skill, p_tel, p_image, p_user, p_pass, p_level, d_id, p_information) 
        VALUES ('$p_prefix', '$p_name', '$p_surname', '$p_birthday', '$p_address', '$p_skill', '$p_tel', '$p_image', '$p_user', '$p_pass', '$p_level', $d_id, '')";

$result = mysqli_query($con, $sql);

if ($result) {
    echo "<script>
        alert('สมัครสมาชิกเรียบร้อยแล้ว');
        window.location.href = 'login.php';
    </script>";
} else {
    echo "ผิดพลาด: " . mysqli_error($con);
}
?>
