<?php
require('conn.php');

// Receive data from addform.php
$p_prefix = mysqli_real_escape_string($con, $_POST["p_prefix"]);
$p_name = mysqli_real_escape_string($con, $_POST["p_name"]);
$p_surname = mysqli_real_escape_string($con, $_POST["p_surname"]);
$p_birthday = mysqli_real_escape_string($con, $_POST["p_birthday"]);
$p_address = mysqli_real_escape_string($con, $_POST["p_address"]);
$p_skill = mysqli_real_escape_string($con, $_POST["p_skill"]);
$p_tel = mysqli_real_escape_string($con, $_POST["p_tel"]);
$d_id = (int)$_POST["d_id"]; // New field for position/rank

// Login data
$p_user = mysqli_real_escape_string($con, $_POST["p_user"]);
$p_pass = md5($_POST["p_pass"]);
$p_level = mysqli_real_escape_string($con, $_POST["p_level"]);

// Handle Image Upload
$p_image = "";
if (isset($_FILES['p_image']) && $_FILES['p_image']['error'] == 0) {
    $target_dir = "image/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_ext = strtolower(pathinfo($_FILES["p_image"]["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid('profile_', true) . '.' . $file_ext;
    $target_file = $target_dir . $new_filename;
    
    // Check if image file is a actual image
    $check = getimagesize($_FILES["p_image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)) {
            $p_image = $new_filename;
        }
    }
}

// Insert data into person table
$sql = "INSERT INTO person (p_prefix, p_name, p_surname, p_birthday, p_address, p_skill, p_tel, p_information, p_image, p_user, p_pass, p_level, d_id) 
        VALUES ('$p_prefix', '$p_name', '$p_surname', '$p_birthday', '$p_address', '$p_skill', '$p_tel', '', '$p_image', '$p_user', '$p_pass', '$p_level', $d_id)";

$result = mysqli_query($con, $sql);

if ($result) {
    header("Location: index.php");
    exit(0);
} else {
    echo "ไม่สามารถเพิ่มข้อมูลได้: " . mysqli_error($con);
}
?>
