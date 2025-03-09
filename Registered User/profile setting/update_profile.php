<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ../../Guest User/Authorize/Log in/login.php');
    exit;
}

$connection = new mysqli('localhost', 'root', '', 'user_database');
if ($connection->connect_error) {
    die('Database Connection Error: ' . $connection->connect_error);
}
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_COOKIE['user_cookie'];

$stmt = $connection->prepare('SELECT * FROM users_table WHERE user_id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
if (!$currentData = $result->fetch_assoc()) {
    die("No admin profile found.");
}

$first_name = htmlspecialchars($currentData['first_name']);
$last_name  = htmlspecialchars($currentData['last_name']);
$username   = htmlspecialchars($currentData['username']);
$email      = htmlspecialchars($currentData['email']);
$created_at = htmlspecialchars($currentData['created_at']);
$updated_at = htmlspecialchars($currentData['updated_at']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_first = htmlspecialchars($_POST['first_name']);
    $new_last  = htmlspecialchars($_POST['last_name']);
    $new_user  = htmlspecialchars($_POST['username']);
    $new_email = htmlspecialchars($_POST['email']);
    $new_pass  = $_POST['password']; 
    $updated_at = date('Y-m-d H:i:s');

    $changes = [];
    $params = [];
    $types  = '';

    if ($new_first !== $currentData['first_name']) {
        $changes[] = "first_name = ?";
        $params[] = $new_first;
        $types .= 's';
    }
    if ($new_last !== $currentData['last_name']) {
        $changes[] = "last_name = ?";
        $params[] = $new_last;
        $types .= 's';
    }
    if ($new_user !== $currentData['username']) {
        $changes[] = "username = ?";
        $params[] = $new_user;
        $types .= 's';
    }
    if ($new_email !== $currentData['email']) {
        $changes[] = "email = ?";
        $params[] = $new_email;
        $types .= 's';
    }
    if (!empty($new_pass)) {
        if (strlen($new_pass) <= 6 || !preg_match('/[a-zA-Z]/', $new_pass) || !preg_match('/\d/', $new_pass) || !preg_match('/[@$!%*?&_]/', $new_pass)) {
            $_SESSION['message'] = "Password must be >6 chars, include a letter, a number, & a special character.";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
        $changes[] = "password = ?";
        $params[] = password_hash($new_pass, PASSWORD_DEFAULT);
        $types .= 's';
    }

    if ($changes) {
        $changes[] = "updated_at = ?";
        $params[] = $updated_at;
        $types .= 's';
        $query = "UPDATE user_table SET " . implode(", ", $changes) . " WHERE user_id = ?";
        $params[] = $user_id;
        $types .= 'i';

        $stmt = $connection->prepare($query);
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Updated successfully!';
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }
    } else {
        $_SESSION['message'] = "No changes were made.";
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

$connection->close();
?>
