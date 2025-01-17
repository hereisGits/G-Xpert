<?php
require_once '../Connection/db_connection.php'; 

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
   
    $query = $connection->prepare("DELETE FROM user_table WHERE user_id = ?");
    $query->bind_param('i', $user_id);

    if ($query->execute()) {
        header("Location: ../manage_user.php?message=User deleted successfully");
        exit;
    } else {
        header("../Location: manage_user.php?error=Error deleting user");
        exit;
    }
} else {
    header("../Location: manage_user.php?error=No user ID provided");
    exit;
}
?>
