<?php
session_start();
session_unset();
session_destroy();

 if (isset($_COOKIE['admin_cookie'])) {
    setcookie('admin_cookie', '', time() - 3600, '/');
}

header('Location: ../login/Admin_login.php');  
exit;
?>
