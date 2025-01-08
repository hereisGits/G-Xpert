<?php
session_start();
require_once('../Function/function_auth.php');

$error = [];
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!checkRequiredField($_POST['email'])) {
        $error['email'] = "Email is required.";
    } elseif (!emailValidate($_POST['email'])) {
        $error['email'] = "Please enter a valid email address.";
    }
    
    if (!checkRequiredField($_POST['password'])) {
        $error['password'] = "Password is required.";
    }


    if (empty($error)) {
        $connection = new mysqli('localhost', 'root', '', 'user_database');
        if ($connection->connect_error) {
            die("Database Connection Failed: " . $connection->connect_error);
        }

        $stmt = $connection->prepare("SELECT email, password, username FROM user_table WHERE email = ?");

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if (!empty($row['password']) && password_verify($password, $row['password'])) {
                
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                if (isset($_POST['remember'])) {
                        setcookie('user_cookie', $row['user_id'], time() + (10 * 24 * 60 * 60), "/", "", false, true); // 'secure' set to false for local testing
                    }
                    
                    header('Location: ../../../Registered%20User/user_dashboard.php');
                    exit();
            } else {
                $error['password'] = "Incorrect password.";
            }
        } else {
            $status = "No account found with that email.";
        }

        $stmt->close();
        $connection->close();
    }
}

?>
