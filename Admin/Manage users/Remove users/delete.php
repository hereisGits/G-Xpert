<?php
require_once '../Connection/db_connection.php'; 

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
   
    $query = $connection->prepare("DELETE FROM user_table WHERE user_id = ?");
    $query->bind_param('i', $user_id);

    if ($query->execute()) {
        header("Location: /server/Code/zProject/Course%20Seller/Admin/Admin_dashboard.php?message=User deleted successfully");
        exit;
    } else {
        header("Location: /server/Code/zProject/Course%20Seller/Admin/Admin_dashboard.?error=Error deleting user");
        exit;
    }
} else {
    header("Location: /server/Code/zProject/Course%20Seller/Admin/Admin_dashboard.?error=No user ID provided");
    exit;
}
?>
