<?php
session_start();

if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_cookie'])) {
    header('Location: ../../Guest User/Authorize/Log in/login.php');
    exit;
}

$connection = new mysqli('localhost', 'root', '', 'user_database');
if ($connection->connect_error) {
    die('Database Connection Error: ' . $connection->connect_error);
}


$user_id = $_SESSION['user_id'] ?? $_COOKIE['admin_cookie'];

$query = $connection->prepare('SELECT * FROM user_table WHERE user_id = ?');
$query->bind_param('i', $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = htmlspecialchars($row['first_name']);
    $last_name = htmlspecialchars($row['last_name']);
    $username = htmlspecialchars($row['username']);
    $email = htmlspecialchars($row['email']);
    $password = $row['password']; 
    $created_at = htmlspecialchars($row['created_at']);
} else {
    die("No admin profile found.");
}

$user_id = $_SESSION['user_id']; 
$fetch_data = "SELECT first_name, last_name FROM user_table WHERE user_id = ?";
$stmt = $connection ->prepare($fetch_data);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $initials = strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1));
} else {
    $initials = "U"; //default user
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password']; 
    $role = htmlspecialchars($_POST['role']);
    $updated_at = date('Y-m-d H:i:s'); 

    $query = 'UPDATE user_table SET username = ?, role = ?, updated_at = ?';
    $params = [$username, $role, $updated_at];
    $types = 'sss';

    
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query .= ', password = ?';
        $params[] = $hashedPassword;
        $types .= 's';
    }

    $query .= ' WHERE user_id = ?';
    $params[] = $user_id;
    $types .= 'i';

    $stmt = $connection->prepare($query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $success = 'Updated successfully!';
    } else {
        $message = "Error updating profile: " . $stmt->error;
    }
}

$connection->close();
?>
