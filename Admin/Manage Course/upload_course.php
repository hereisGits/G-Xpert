
<?php
require_once '../Manage users/Connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['courseTitle'];
    $description = $_POST['description'];
    $schedule = $_POST['schedule'];

    if (empty($title) || empty($description) || empty($schedule) || !isset($_FILES['video'])) {
        $error = "All fields are required!";
        exit;
    }

    $video = $_FILES['video'];
    $allowedTypes = ['video/mp4', 'video/avi'];
    $maxSize = 50 * 1024 * 1024;

    if (!in_array($video['type'], $allowedTypes)) {
        $error = "Invalid video file type!";
        exit;
    }

    if ($video['size'] > $maxSize) {
        $error = "File size exceeds the limit of 50MB!";
        exit;
    }

    if (!file_exists('uploads/videos')) {
        mkdir('uploads/videos', 0777, true);
    }

    $videoPath = 'uploads/videos/' . basename($video['name']);
    if (!move_uploaded_file($video['tmp_name'], $videoPath)) {
        $error = "Failed to upload video!";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO courses (title, description, video_path, schedule) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $videoPath, $schedule);

    if ($stmt->execute()) {
        $success = "Video uploaded successfully!";
    } else {
        $message = "Error: " . $stmt->error;
        error_log($stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>