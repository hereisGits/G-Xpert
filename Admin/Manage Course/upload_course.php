<?php
require_once '../Manage users/Connection/db_connection.php';

$message = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['courseTitle'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $schedule = !empty($_POST['schedule']) ? $_POST['schedule'] : NULL;

    if (empty($title) || empty($description) || !isset($_FILES['video'])) {
        $message = "Error: Title, description, and video are required!";
    } else {
        $video = $_FILES['video'];
        $allowedTypes = ['video/mp4', 'video/avi'];
        $maxSize = 100 * 1024 * 1024;

        if (!in_array($video['type'], $allowedTypes)) {
            $message = "Error: Invalid video file type! Only MP4 and AVI allowed." .$video->error;
        } elseif ($video['size'] > $maxSize) {
            $message = "Error: File size exceeds 100MB!";
        } elseif (isset($schedule) && strtotime($schedule) < time()) {
            $message = "Error: Schedule must be a future date!";
        } else {
            $uploadDir = 'uploads/videos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $videoPath = $uploadDir . time() . "_" . basename($video['name']);
            if (!move_uploaded_file($video['tmp_name'], $videoPath)) {
                $message = "Error: Failed to upload video!";
            } else {
                if (!$connection) {
                    $message = "Error: Database connection failed!";
                } else {
                    if ($schedule === NULL) {
                        $stmt = $connection->prepare("INSERT INTO courses (title, description, video_path) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $title, $description, $videoPath);
                    } else {
                        $stmt = $connection->prepare("INSERT INTO courses (title, description, video_path, schedule) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $title, $description, $videoPath, $schedule);
                    }

                    if ($stmt->execute()) {
                        $success = "Video uploaded successfully!";
                    } else {
                        $message = "Error: Could not save to database. " . $stmt->error;
                    }
                    
                    $stmt->close();
                }
            }
        }
    }
}
?>
