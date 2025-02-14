<?php
$conn = new mysqli("localhost", "root", "", "user_database");
if ($conn->connect_error) {
    die('Database Error: ' . $conn->connect_error);
}

$sql = "SELECT * FROM courses ORDER BY id DESC";
$result = $conn->query($sql);

$content = "";
$emptyContent = "";   

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $content .= "<div class='course-item'>
                        <div class='video-container'>
                            <video controls>
                                <source src='" . htmlspecialchars($row['video_path']) . "' type='video/mp4'>
                                Your browser does not support the video tag.
                            </video>
                        </div>
                            <div class='course-content'>
                                <h4>" . htmlspecialchars($row['title']) . "</h4>
                                <p class ='description'>" . htmlspecialchars($row['description']) . "</p>
                            </div>
                            <div class='upload_date'>
                                <p class='price'> <i class='fa-solid fa-indian-rupee-sign'></i> " . htmlspecialchars($row['price']) . "</p>
                                <p>" . htmlspecialchars($row['uploaded_at']) . "</p>
                            </div>
                    </div>";
    }
} else {
    $emptyContent = "<p class='no-courses'>No courses available.</p>";
}

$conn->close();
