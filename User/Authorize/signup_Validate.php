<?php
session_start();

require_once('Function/function_auth.php');


$error = [];
$error_box = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!checkRequiredField($_POST['fname'])) {
        $error['fname'] = "First name is required.";
    }

    if (!checkRequiredField($_POST['lname'])) {
        $error['lname'] = "Last name is required.";
    }

    if (!checkRequiredField($_POST['username'])) {
        $error['username'] = "Username is required.";
    } elseif (!usernameValidate($_POST['username'])) {
        $error['username'] = "Invalid username. Must be 4-8 characters, start with a letter, and contain only letters, numbers & underscore.";
    }

    if (!checkRequiredField($_POST['email'])) {
        $error['email'] = "Email is required.";
    } elseif (!emailValidate($_POST['email'])) {
        $error['email'] = "Please enter a valid email address.";
    }

    if (!checkRequiredField($_POST['password'])) {
        $error['password'] = "Password is required.";
    } elseif (!passValidate($_POST['password'])) {
        $error['password'] = "Password must be at least 6 characters, a number, and a special character.";
    }

    if (!isset($_POST['term&con'])) {
        $error['term&con'] = 'You must accept the terms & conditions';
    }

    if (empty($error)) {
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $user_name = strtolower($_POST['username']);
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        try {
            $connection = new mysqli('localhost', 'root', '', 'user_database');
            if ($connection->connect_error) {
                die("Database connection failed: " . $connection->connect_error);
            } else {
                $check_user = $connection->prepare("SELECT username, email FROM user_table WHERE username = ? OR email = ?");
                $check_user->bind_param('ss', $user_name, $email);
                $check_user->execute();
                $check_user->store_result();

                if ($check_user->num_rows > 0) {
                    $check_user->bind_result($existing_username, $existing_email);
                    $check_user->fetch();
                    $status = "The " . ($existing_username == $user_name ? "Username" : "Email") . " already exists.";
                } else {
                    $insert_data = $connection->prepare("INSERT INTO user_table(first_name, last_name, username, email, password) VALUES(?, ?, ?, ?, ?)");
                    $insert_data->bind_param("sssss", $first_name, $last_name, $user_name, $email, $password);
                    $insert_data->execute();

                    if ($connection->affected_rows > 0) {
                        $success = "Account Created Successfully";
                        
                        $user_id = $insert_data->insert_id;
                        $user_name = $_POST['username']; 
                        
                        $_SESSION['user_id'] = $user_id;   
                        $_SESSION['username'] = $user_name; 
                        
                        setcookie('user_cookie', $user_name, time() + (10 * 24 * 60 * 60), '/');
                        header('Location: ../User page/user_profile.php');
                        exit();
                                                           
                    } else {
                        $status = "Submission Failed.";
                    }

                    $insert_data->close();
                }

                $check_user->close();
            }

            $connection->close();
        } catch (Exception $ex) {
            $status = "Database error: " . $ex->getMessage();
        }
    }
}
?>
