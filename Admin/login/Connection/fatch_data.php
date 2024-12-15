<?php
    require_once '../login/Admin_login.php';
    // session_start();
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
        try {
            $connection = new mysqli('localhost', 'root', '', 'user_database');
            if ($connection->connect_error) {
                die('Database connection error: ' . $connection->connect_error);

            }else{    
                    $stmt = $connection->prepare('SELECT password FROM admin_table WHERE username = ?');
                    $stmt->bind_param('s', $username);
                    $stmt->execute();
                    $result = $stmt->get_result();
            
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        if ($password == $row['password']) {
                        // $_SESSION['username'] = $rew['username'];
                        //    setcookie('admin_cookie', $row['username'], time() + (60 * 60), '/');

                        header('Location : ../Admin_Dashboard.php');
                        exit;
                        } else {
                            $message = "Incorrect password! Try again.";
                        }
                    } else {
                        $message = "Username not found.";           
                    }            
                    $stmt->close();
                }
            $connection->close();

        } catch (Exception $ex) {
            $message = "Initial Error:".$ex->getMessage();
        }
    }       
}
?>