<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$connection = new mysqli('localhost', 'root', '', 'user_database');
if ($connection->connect_error) {
    die('Database Connection Error: ' . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_id = intval($_POST['video_id']);

    if ($video_id <= 0) { 
        $_SESSION['message'] = 'Invalid Course ID';
        echo 'error: Invalid Course ID';
        exit();
    }

    echo "Debug: video_id = $video_id<br>";

    $query = $connection->prepare('DELETE FROM videos_table WHERE video_id = ?');
    if (!$query) {
        echo 'error: Failed to prepare query - ' . $connection->error;
        exit();
    }

    $query->bind_param('i', $video_id);
    if (!$query->execute()) {
        echo 'error: Failed to execute query - ' . $query->error;
        exit();
    }
    if ($query->affected_rows > 0) { 
        echo 'success';
    } else {
        echo 'error: Course ID not found';
    }
    $query->close();
} else {
    echo 'error: Invalid request method.';
}
$connection->close();
?>