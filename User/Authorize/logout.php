<?php 
    session_start();
    session_unset();
    session_destroy();  

    if (isset($_COOKIE['user_cookie'])) {
        setcookie('user_cookie', '', time() - 3600, '/');
    }

    header('Location: login.php');
    exit;
?>
