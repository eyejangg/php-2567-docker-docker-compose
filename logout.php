<?php
session_start(); // เริ่มใช้ session
session_destroy(); // ทำลาย session และ ส่งไปยัง location index.php
header("Location: login.php");
exit;
?>