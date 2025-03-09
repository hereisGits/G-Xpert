<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './Manage users/Connection/db_connection.php';

$success = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $tokens = $_POST['tokens'];

    if (isset($_POST['admin_id']) && !empty($_POST['admin_id'])) {
        $admin_id = $_POST['admin_id'];
    } else {
        $_SESSION['message'] = "Admin ID is required!";
        header('Location: '.$_SERVER['PHP_SELF']);
        exit();
    }

    // Check if user exists
    $stmt = $connection->prepare("SELECT * FROM users_table WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Insert token transaction
        $stmt = $connection->prepare("INSERT INTO user_tokens (user_id, tokens_added, added_by_admin_id) VALUES (?, ?, ?)");
        $stmt->bind_param('iii', $user_id, $tokens, $admin_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['success'] = "Tokens added successfully!";
        } else {
            $_SESSION['message'] = "Error adding tokens!";
        }
    } else {
        $_SESSION['message'] = "User not found!";
    }
    
    header('Location: '.$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

?>
