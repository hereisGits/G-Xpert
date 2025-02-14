<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once '../Manage users/Connection/db_connection.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['courseTitle']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $schedule = !empty($_POST['schedule']) ? $_POST['schedule'] : NULL;
    $video = $_FILES['video'] ?? null;

    if (empty($title) || empty($description) || empty($price)) {
        $_SESSION['message'] = "Title, description, price are required!";

    } elseif (!is_numeric($price)) {
        $_SESSION['message'] = "Price must be a valid number!";

    } elseif (!in_array($video['type'], ['video/mp4', 'video/avi'])) {
        $_SESSION['message'] = "Only MP4 and AVI videos allowed!";

    } elseif ($video['size'] > 100 * 1024 * 1024) {
        $_SESSION['message'] = "File size exceeds 100MB!";
        
    } elseif($schedule && strtotime($schedule) <= time()) {
        $_SESSION['message'] = "Schedule must be a future date!";
    }

    $uploadDir = 'uploads/videos/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    $videoPath = $uploadDir . time() . "_" . basename($video['name']);
    if (move_uploaded_file($video['tmp_name'], $videoPath) && $connection) {
        $stmt = $connection->prepare(
            "INSERT INTO courses (title, description, price, video_path, schedule) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssdss", $title, $description, $price, $videoPath, $schedule);
        
        $_SESSION['success'] = $stmt->execute() ? "Video uploaded successfully!" : "Database error!";
        $stmt->close();
    } else {
        $_SESSION['message'] = "Video upload failed!";
    }


    header("Location: manage_course.php");
    exit();
}
