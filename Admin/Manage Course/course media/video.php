<?php
$video = urldecode($_GET['video']);
$title = urldecode($_GET['title']);
$desc = urldecode($_GET['desc']);
$price = urldecode($_GET['price']);
$date = urldecode($_GET['date']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #121212;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }

        h1 {
            color: #fff;
            font-size: 28px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #ccc;
            margin-bottom: 10px;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: #27ae60;
        }

        .video-container {
            width: 100%;
            margin: 20px 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
        }

        video {
            width: 100%;
            border-radius: 12px;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background: #27ae60;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            background: #219150;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="video-container">
        <video controls autoplay>
            <source src="http://localhost/server/Code/zProject/Course%20Seller/Admin/Manage%20Course/<?php echo htmlspecialchars($video); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <h1><?php echo htmlspecialchars($title); ?></h1>
    <p><?php echo htmlspecialchars($desc); ?></p>
    <p class="price"><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo htmlspecialchars($price); ?></p>
    <p>Uploaded on: <?php echo htmlspecialchars($date); ?></p>

    <a href="index.php" class="btn"><i class="fa-solid fa-arrow-left"></i> Back to Courses</a>
</div>
<?php require_once 'fetch_course.php'; ?>
</body>
</html>
