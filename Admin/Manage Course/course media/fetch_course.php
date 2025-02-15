<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #f4f4f4;
        color: #333;
        line-height: 1.6;
    }

    .course-list {
        width: 100%;
        max-width: 1400px;
        padding: 30px;
        background: white;
        border-radius: 12px;
        border: 1px solid rgba(173, 173, 173, 0.8);
        text-align: center;
        margin: 0 auto;
    }

    .video-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        justify-content: center;
        align-items: start;
        margin: 0 auto;
        padding-bottom: 20px;
    }

    .course-item {
        max-width: 280px;
        width: 100%;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        text-align: center;
        margin: 0 auto;
    }

    .course-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .video-container {
        width: 100%;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
    }

    .video-container video {
        width: 100%;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .video-container video:hover {
        transform: scale(1.05);
    }

    .course-content h4 {
        text-align: left;
        font-size: 18px;
        margin: 10px 0 5px;
        color: #2c3e50;
        font-weight: 700;
    }

    .course-content .description {
        color: #7f8c8d;
        font-size: 14px;
        line-height: 1.6;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
    }

    .course-content .description:hover {
        /* white-space: normal; */
        /* overflow: visible; */
        text-overflow: unset;
        color: #34495e;
        text-align: left;
    }

    .upload_date {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        color: #555;
        border-top: 1px solid #ddd;
        padding-top: 8px;
        margin-top: 10px;
    }

    .upload_date .price {
        font-weight: 700;
        font-size: 16px;
        color: #27ae60;
    }

    .no-courses {
        text-align: center;
        color: #888;
        font-size: 18px;
        font-style: italic;
        padding: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .course-list {
            padding: 20px;
        }

        .video-list {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .course-content h4 {
            font-size: 16px;
        }

        .course-content .description {
            font-size: 13px;
        }

        .upload_date {
            font-size: 13px;
        }

        .upload_date .price {
            font-size: 15px;
        }
    }

    @media (max-width: 480px) {
        .course-list {
            width: 95%;
            padding: 15px;
        }

        .video-list {
            grid-template-columns: 1fr;
        }

        .course-item {
            max-width: 100%;
        }
    }
</style>
</head>
<body>

<div class="course-list">
    <div class="video-list">
        <?php
            $conn = new mysqli("localhost", "root", "", "user_database");
            if ($conn->connect_error) {
                die('Database Error: ' . $conn->connect_error);
            }

            $sql = "SELECT * FROM courses ORDER BY id DESC";
            $result = $conn->query($sql);
            $content = "";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $content .= "<div class='course-item'>
                                    <div class='video-container'>
                                        <video controls>
                                            <source src='http://localhost/server/Code/zProject/Course%20Seller/Admin/Manage%20Course/" . htmlspecialchars($row['video_path']) . "' type='video/mp4'>
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    <div class='course-content'>
                                        <h4>" . htmlspecialchars($row['title']) . "</h4>
                                        <p class='description' title= '" . htmlspecialchars($row['description']) ."'>" . htmlspecialchars($row['description']) . "</p>
                                    </div>
                                    <div class='upload_date'>
                                        <p class='price'> <i class='fa-solid fa-indian-rupee-sign'></i> " . htmlspecialchars($row['price']) . "</p>
                                        <p>" . htmlspecialchars($row['uploaded_at']) . "</p>
                                    </div>
                                </div>";
                }
            } else {
                $content = "<p class='no-courses'>No courses available.</p>";
            }

            $conn->close();
            echo $content;
        ?>
    </div>
</div>

</body>
</html>
