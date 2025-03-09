<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$connection = new mysqli('localhost', 'root', '', 'user_database');
if ($connection->connect_error) {
    die('Database Connection Error: ' . $connection->connect_error);
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Fetch course details
    $video_id = $_GET['courseId'] ?? null;
    if (!$video_id || $video_id <= 0) {
        exit('error: Invalid Course ID');
    }

    $query = $connection->prepare('SELECT title, description, price, schedule, status, category, video_path FROM videos_table WHERE video_id = ?');
    $query->bind_param('i', $video_id);
    $query->execute();
    $result = $query->get_result();

    echo ($row = $result->fetch_assoc()) 
        ? implode('|', $row) 
        : 'error: Course ID not found';

} elseif ($method === 'POST') {
    // Update course details
    $courseId = $_POST['courseId'] ?? null;
    if (!$courseId || $courseId <= 0) {
        exit('error: Invalid Course ID');
    }

    $query = $connection->prepare('SELECT video_path FROM videos_table WHERE video_id = ?');
    $query->bind_param('i', $courseId);
    $query->execute();
    $result = $query->get_result();
    if (!$result->num_rows) {
        exit('error: Course ID not found');
    }

    $row = $result->fetch_assoc();
    $video_path = $row['video_path'];

    if (!empty($_FILES['video']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $video_path = $uploadDir . basename($_FILES['video']['name']);
        if (!move_uploaded_file($_FILES['video']['tmp_name'], $video_path)) {
            exit('error: Failed to upload video');
        }
    }

    $updateQuery = $connection->prepare('UPDATE videos_table SET title=?, description=?, price=?, schedule=?, status=?, category=?, video_path=? WHERE video_id=?');
    $updateQuery->bind_param(
        'ssdssssi',
        $_POST['courseTitle'],
        $_POST['description'],
        $_POST['price'],
        $_POST['schedule'],
        $_POST['status'],
        $_POST['category'],
        $video_path,
        $courseId
    );

    if($updateQuery->execute()) {
        echo 'Update successful';
     }else{
        echo 'error: Failed to update course';
     }

} else {
    exit('error: Invalid request method');
}

?>
