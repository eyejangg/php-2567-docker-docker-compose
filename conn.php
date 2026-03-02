<?php
@session_start();

$db_host = getenv('DB_HOST') ?: "localhost";
$db_user = getenv('DB_USER') ?: "root";
$db_pass = getenv('DB_PASSWORD') ?: "root";
$db_name = getenv('DB_NAME') ?: "person";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$con) {
    die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8");
?>
