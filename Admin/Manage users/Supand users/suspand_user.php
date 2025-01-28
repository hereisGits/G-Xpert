<?php
require_once '../Connection/db_connection.php';

$suspensionTimeLeft = "Not Suspended";
if (isset($row['status']) && $row['status'] == 'suspended' && isset($row['suspended_until'])) {
    $timeDiff = strtotime($row['suspended_until']) - time();
    if ($timeDiff > 0) {
        $daysLeft = floor($timeDiff / (60 * 60 * 24));
        $hoursLeft = floor(($timeDiff % (60 * 60 * 24)) / (60 * 60));
        $minutesLeft = floor(($timeDiff % (60 * 60)) / 60);
        $suspensionTimeLeft = "{$daysLeft} days {$hoursLeft} hours {$minutesLeft} minutes";
    } else {
        $suspensionTimeLeft = "Suspension Expired";
    }

    $query = $connection->prepare("UPDATE user_table SET status = 'suspended', suspended_until = ? WHERE user_id = ?");
    $query->bind_param('si', $suspendedUntil, $userId);

    if ($query->execute()) {
        echo json_encode(['success' => true, 'suspended_until' => $suspendedUntil]);
    } else {
        echo json_encode(['success' => false]);
    }

    $connection->close();
}
?>
