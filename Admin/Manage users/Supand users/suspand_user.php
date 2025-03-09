<?php
require_once '../Connection/db_connection.php';

$userId = isset($_GET['id']) ? intval($_GET['id']) : null; 
if ($userId === null) {
    die("User ID is required.");
}

$suspendedUntil = date('Y-m-d H:i:s', strtotime('+30 days'));

$query = $connection->prepare("UPDATE users_table SET status = 'suspended', suspended_until = ? WHERE user_id = ?");
$query->bind_param('si', $suspendedUntil, $userId);

if ($query->execute()) {
    echo "User suspended successfully";
} else {
    echo "Error: " . $query->error; 
}

$query->close();
$connection->close();
?>