<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$connection = new mysqli('localhost', 'root', '', 'user_database');
    if(!$connection){
        die('Database Connection Error:' .$connection->connect_error);
    }

function checkSuspension() {
    if (isset($_SESSION['user_id'])) {
        $connection = new mysqli('localhost', 'root', '', 'user_database');
        if ($connection->connect_error) {
            die("Database Connection Failed: " . $connection->connect_error);
        }

        $userId = $_SESSION['user_id'];

        $stmt = $connection->prepare("SELECT status, suspended_until FROM users_table WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['status'] === 'suspended' && isset($row['suspended_until'])) {
                $suspendedUntil = strtotime($row['suspended_until']);
                if (time() < $suspendedUntil) {
                    session_unset(); 
                    session_destroy(); 
                    header("Location: /Server/Code/zProject/Course%20Seller/Guest%20User/Authorize/Log%20in/login.php?message=You have been suspended until " . date('Y-m-d H:i:s', $suspendedUntil));
                    exit();
                } else {
                    $updateStmt = $connection->prepare("UPDATE users_table SET status = 'active', suspended_until = NULL WHERE user_id = ?");
                    $updateStmt->bind_param('i', $userId);
                    $updateStmt->execute();
                    $updateStmt->close();
                }
            }
        }

        $stmt->close();
        $connection->close();
    }
}

// Call the function to check suspension status
checkSuspension();
?>