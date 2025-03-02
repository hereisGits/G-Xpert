<?php
$conn = new mysqli("localhost", "root", "", "user_database");
if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}

if (isset($_GET['video_id'])) {
    $video_id = intval($_GET['video_id']);

    $query = "SELECT comment.comments, user_table.username, comment.created_at 
              FROM comment 
              JOIN user_table ON comment.user_id = user_table.user_id
              WHERE comment.video_id = ? 
              ORDER BY comment.created_at DESC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $video_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='comment'>";
            echo "<strong>" . htmlspecialchars($row['username']) . "</strong>";
            echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
            echo "<small>" . date("F j, Y, g:i a", strtotime($row['created_at'])) . "</small>";
            echo "</div>";
        }
    } else {
        echo "<p>No comment yet. Be the first to comment!</p>";
    }

    $stmt->close();
}

$conn->close();
?>