<?php
require_once '../Connection/db_connection.php';

$userId = isset($_GET['id']) ? intval($_GET['id']) : null; 
if ($userId === null) {
    die("User ID is required.");
}

$query = $connection->prepare("UPDATE users_table SET status = 'active', suspended_until = NULL WHERE user_id = ?");
$query->bind_param('i', $userId);

if ($query->execute()) {
    echo "User unsuspended successfully";
} else {
    echo "Error: " . $query->error; 
}

$query->close();
$connection->close();
?>