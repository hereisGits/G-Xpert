<?php
session_start();

$error = [];
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && !empty(trim($_POST['username']))) {
        $username = trim($_POST['username']);
    } else {
        $error['username'] = "Enter your username";
    }

    if (isset($_POST['password']) && !empty(trim($_POST['password']))) {
        $password = trim($_POST['password']);
    } else {
        $error['password'] = "Enter your password";
    }

    if (empty($error)) {
        $connection = new mysqli('localhost', 'root', '', 'user_database');
        if ($connection->connect_error) {
            die('Database connection error: ' . $connection->connect_error);
        }

        $stmt = $connection->prepare('SELECT admin_id, username, password FROM admin_table WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                // Set session and cookie
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['username'] = $row['username'];
                setcookie('admin_cookie', $row['admin_id'], time() + (60 * 60), '/');

                header('Location: ../../dashboard.php');
                exit;
            } else {
                $message = "Incorrect password! Try again.";
            }
        } else {
            $message = "Username not found.";
        }

        $stmt->close();
        $connection->close();
    }
}
?>