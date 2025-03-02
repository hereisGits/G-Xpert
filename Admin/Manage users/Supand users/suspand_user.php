<?php
require_once '../Connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? null;
    $days = (int) ($_POST['days'] ?? 0);

    if (!ctype_digit($userId) || $days <= 0) {
        die("Invalid input.");
    }

    $userId = (int) $userId;

    // Check if user exists
    $stmt = $conn->prepare("SELECT user_id FROM user_table WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        die("User not found.");
    }

    // Suspend user
    $suspendUntil = date('Y-m-d H:i:s', strtotime("+$days days"));
    $updateQuery = $conn->prepare("UPDATE user_table SET status='suspended', suspended_until=? WHERE user_id=?");
    $updateQuery->bind_param("si", $suspendUntil, $userId);
    
    echo $updateQuery->execute() ? "User suspended until $suspendUntil" : "Error: " . $conn->error;

    $stmt->close();
    $updateQuery->close();
    $conn->close();
}
?>
