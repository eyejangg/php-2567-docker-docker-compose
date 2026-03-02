<?php
require('conn.php');

// Receive data from editform.php
$p_id = (int)$_POST["p_id"];
$p_prefix = mysqli_real_escape_string($con, $_POST["p_prefix"]);
$p_name = mysqli_real_escape_string($con, $_POST["p_name"]);
$p_surname = mysqli_real_escape_string($con, $_POST["p_surname"]);
$p_birthday = mysqli_real_escape_string($con, $_POST["p_birthday"]);
$p_address = mysqli_real_escape_string($con, $_POST["p_address"]);
$p_skill = mysqli_real_escape_string($con, $_POST["p_skill"]);
$p_tel = mysqli_real_escape_string($con, $_POST["p_tel"]);
$d_id = (int)$_POST["d_id"];

// Update person table
$sql_Update = "UPDATE person 
               SET p_prefix = '$p_prefix', 
                   p_name = '$p_name', 
                   p_surname = '$p_surname', 
                   p_birthday = '$p_birthday', 
                   p_address = '$p_address', 
                   p_skill = '$p_skill', 
                   p_tel = '$p_tel', 
                   d_id = $d_id 
               WHERE p_id = $p_id";

$result = mysqli_query($con, $sql_Update);

if ($result) {
    header("Location: index.php");
    exit(0);
} else {
    echo "แก้ไขข้อมูลไม่ได้: " . mysqli_error($con);
}
?>