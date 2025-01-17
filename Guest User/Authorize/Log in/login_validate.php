<?php
session_start();
require_once('../Function/function_auth.php');

$error = [];
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!checkRequiredField($_POST['email'])) {
        $error['email'] = "Email is required.";
    } elseif (!emailValidate($_POST['email'])) {
        $error['email'] = "Invalid email address.";
    }
    
    if (!checkRequiredField($_POST['password'])) {
        $error['password'] = "Password is required.";
    }


    if (empty($error)) {
        $connection = new mysqli('localhost', 'root', '', 'user_database');
        if ($connection->connect_error) {
            die("Database Connection Failed: " . $connection->connect_error);
        }

        $email =  $_POST['email'];
        $password = $_POST['password'];

        $stmt = $connection->prepare("SELECT email, password, user_id, username FROM user_table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            
            if (isset($_POST['remember'])) {
                    setcookie('user_cookie', $row['user_id'], time() + (24 * 60 * 60), "/", "", false, true); // 'secure' set to false for local testing
                }  
                
                if (!empty($row['password']) && password_verify($password, $row['password'])) {                
                    header("Location: ../../../Registered User/user_dashboard.php");
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
