<?php
session_start();
require_once 'Manage Course/course media/upload_course.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = $_POST['courseId'];
    $courseTitle = $_POST['courseTitle'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $schedule = $_POST['schedule'];

    // Handle file upload (if a new video is provided)
    $videoPath = null;
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['video']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFilePath)) {
            $videoPath = $uploadFilePath;
        }
    }

    // Update course details in the database
    if ($videoPath) {
        $query = $connection->prepare('UPDATE courses SET courseTitle = ?, description = ?, price = ?, schedule = ?, videoPath = ? WHERE courseId = ?');
        $query->bind_param('ssdssi', $courseTitle, $description, $price, $schedule, $videoPath, $courseId);
    } else {
        $query = $connection->prepare('UPDATE courses SET courseTitle = ?, description = ?, price = ?, schedule = ? WHERE courseId = ?');
        $query->bind_param('ssdsi', $courseTitle, $description, $price, $schedule, $courseId);
    }

    if ($query->execute()) {
        echo 'success'; 
    } else {
        echo 'Failed to update course.';
    }
} else {
    echo 'Invalid request method.'; 
}
?>