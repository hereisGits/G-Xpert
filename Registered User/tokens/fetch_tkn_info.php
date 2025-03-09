<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ../../Guest User/Authorize/Log in/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];


$query = "SELECT total_tokens FROM user_tokens WHERE user_id = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_tokens = $row['total_tokens'];
} else {

    $total_tokens = 0;  
}
$stmt->close();
?>
