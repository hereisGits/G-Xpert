<?php
$conn = new mysqli("localhost", "root", "", "user_database");
if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}

if (isset($_GET['video_id'])) {
    $video_id = intval($_GET['video_id']);

    $query = "SELECT video_feedback.comments, users_table.username, video_feedback.created_at 
              FROM video_feedback 
              JOIN users_table ON video_feedback.user_id = users_table.user_id
              WHERE video_feedback.video_id = ? 
              ORDER BY video_feedback.created_at DESC";

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