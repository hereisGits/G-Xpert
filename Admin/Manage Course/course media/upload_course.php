<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../Manage users/Connection/db_connection.php';

$message = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $title = trim($_POST['courseTitle']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $schedule = !empty($_POST['schedule']) ? $_POST['schedule'] : NULL;

    if (empty($title) || empty($description) || !isset($price) || !isset($_FILES['video'])) {
        $_SESSION['message'] = "Error: Title, description, price, and video are required!";
    } else {
        $video = $_FILES['video'];
        $allowedTypes = ['video/mp4', 'video/avi'];
        $maxSize = 100 * 1024 * 1024; // 100MB

        if (!in_array($video['type'], $allowedTypes)) {
            $_SESSION['message'] = "Error: Invalid video file type! Only MP4 and AVI allowed.";
        } elseif ($video['size'] > $maxSize) {
            $_SESSION['message'] = "Error: File size exceeds 100MB!";
        } elseif (isset($schedule) && strtotime($schedule) < time()) {
            $_SESSION['message'] = "Error: Schedule must be a future date!";
        } else {
            $uploadDir = 'uploads/videos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $videoPath = $uploadDir . time() . "_" . basename($video['name']);
            if (!move_uploaded_file($video['tmp_name'], $videoPath)) {
                $_SESSION['message'] = "Error: Failed to upload video!";
            } else {
                if (!$connection) {
                    $_SESSION['message'] = "Error: Database connection failed!";
                } else {
                    if ($schedule === NULL) {
                        $stmt = $connection->prepare("INSERT INTO courses (title, description, price, video_path) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $title, $description, $price, $videoPath);
                    } else {
                        $stmt = $connection->prepare("INSERT INTO courses (title, description, price, video_path, schedule) VALUES (?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssss", $title, $description, $price, $videoPath, $schedule);
                    }

                    if ($stmt->execute()) {
                        echo "Video uploaded successfully!";
                        $_SESSION['success'] = "Video uploaded successfully!";
                    } else {
                        echo "Error: Could not save to database. " . $stmt->error;
                        $_SESSION['message'] = "Error: Could not save to database. " . $stmt->error;
                    }
                    
                    $stmt->close();
                }
            }
        }
    }
    
    header("Location: manage_course.php"); 
    exit();
}

?>
