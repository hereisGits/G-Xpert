<?php
session_start();
require_once 'course media/upload_course.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = $_POST['courseId'];

    // Fetch the video path before deleting the course
    $query = $connection->prepare('SELECT videoPath FROM courses WHERE courseId = ?');
    $query->bind_param('i', $courseId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $videoPath = $row['videoPath'];

        // Delete the video file if it exists
        if ($videoPath && file_exists($videoPath)) {
            unlink($videoPath);
        }
    }


    $query = $connection->prepare('DELETE FROM courses WHERE courseId = ?');
    $query->bind_param('i', $courseId);

    if ($query->execute()) {
        echo 'success'; 
    } else {
        echo 'Failed to delete course.'; 
    }
} else {
    echo 'Invalid request method.'; 
}
?>