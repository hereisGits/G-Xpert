<?php
session_start();

require_once '../Connection/db_connection.php';
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    if ($user_id <= 0) {
        echo "Invalid user ID";
        exit;
    }

    $query = $connection->prepare("DELETE FROM user_table WHERE user_id = ?");
    $query->bind_param('i', $user_id);

    if ($query->execute()) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $query->error;
    }
    $query->close();
} else {
    echo "No user ID provided";
}
$connection->close();
?>