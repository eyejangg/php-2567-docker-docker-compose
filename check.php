<?php
require("conn.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = md5($_POST['password']); // Note: In a production app, password_hash is preferred

    $sql = "SELECT * FROM person WHERE p_user='$username' AND p_pass='$password' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Store user info in session
        $_SESSION["p_id"] = $row["p_id"];
        $_SESSION["p_name"] = $row["p_prefix"] . $row["p_name"] . " " . $row["p_surname"];
        $_SESSION["p_level"] = $row["p_level"];
        $_SESSION["p_username"] = $row["p_user"];

        // Redirect based on level
        if ($_SESSION["p_level"] == "a") {
            header("Location: admin_page.php");
        } else {
            header("Location: user_page.php");
        }
        exit;
    } else {
        echo "<script>";
        echo "alert('Username หรือ Password ไม่ถูกต้อง!');";
        echo "window.history.back();";
        echo "</script>";
    }
} else {
    header("Location: login.php");
    exit;
}
?>