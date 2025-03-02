<?php
session_start();

$conn = new mysqli("localhost", "root", "", "user_database");
if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}

if (isset($_POST['comment']) && isset($_POST['video_id'])) {
    $video_id = intval($_POST['video_id']);
    $comment = htmlspecialchars($_POST['comment']);

    $query = "INSERT INTO comments (video_id, comment) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $video_id, $comment);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Comment submitted successfully.";
    } else {
        echo "Error submitting comment.";
    }

    $stmt->close();
}

$conn->close();
?>