<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$connection = new mysqli('localhost', 'root', '', 'user_database');
if ($connection->connect_error) {
    die('Database Connection Error: ' . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['courseTitle']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $schedule = !empty($_POST['schedule']) ? $_POST['schedule'] : NULL;
    $status = trim($_POST['status']);
    $category = trim($_POST['category']);
    $video = $_FILES['video'] ?? null;

    if (empty($title) || empty($description) || empty($price)) {
        echo "error: Title, description, and price are required!";
        exit;
    } elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $price)) {
        echo "error: Invalid price format!";
        exit;
    } elseif (!$video || !in_array($video['type'], ['video/mp4'])) {
        echo "error: Only MP4 videos allowed!";
        exit;
    } elseif ($video['size'] > 100 * 1024 * 1024) {
        echo "error: File size exceeds 100MB!";
        exit;
    } elseif ($schedule && strtotime($schedule) <= time()) {
        echo "error: Schedule must be a future date!";
        exit;
    } elseif (empty($status) || empty($category)) {
        echo "error: Status and category are required!";
        exit;
    } else {
        $uploadDir = 'uploads/videos/';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
            echo "error: Failed to create upload directory!";
            exit;
        }

        $fileName = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", basename($video['name'])); 
        $videoPath = $uploadDir . $fileName;

        if (move_uploaded_file($video['tmp_name'], $videoPath)) {
            $stmt = $connection->prepare("INSERT INTO videos_table (title, description, price, video_path, schedule, status, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssdssss", $title, $description, $price, $videoPath, $schedule, $status, $category);
                if ($stmt->execute()) {
                    echo 'success'; 
                } else {
                    echo "error: Database error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "error: Database preparation error!";
            }
        } else {
            echo "error: Failed to move uploaded file!";
        }
    }
    exit();
}
?>
