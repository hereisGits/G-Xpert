<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to post a comment.");
}

$conn = new mysqli("localhost", "root", "", "user_database");
if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}

if (isset($_POST['comment']) && isset($_POST['video_id'])) {
    $video_id = intval($_POST['video_id']);
    $comment = trim($_POST['comment']);
    $user_id = $_SESSION['user_id'];


    if (empty($comment)) {
        die("Comment cannot be empty.");
    }
    if ($video_id <= 0) {
        die("Invalid video ID.");
    }


    $query = "INSERT INTO video_feedback (user_id, video_id, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("iis", $user_id, $video_id, $comment);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "Error submitting comment.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>