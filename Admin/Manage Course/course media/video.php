<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$video_id = isset($_GET['id']) ? $_GET['id'] : '';
$video = isset($_GET['video']) ? htmlspecialchars(urldecode($_GET['video'])) : '';
$title = isset($_GET['title']) ? htmlspecialchars(urldecode($_GET['title'])) : '';
$desc = isset($_GET['desc']) ? htmlspecialchars(urldecode($_GET['desc'])) : '';
$price = isset($_GET['price']) ? htmlspecialchars(urldecode($_GET['price'])) : '';
$date = isset($_GET['date']) ? htmlspecialchars(urldecode($_GET['date'])) : '';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $video; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1400px;
            background: #fff;
            padding: 20px;
            gap: 50px;
            margin: auto;
        }

        .video-sec {
            max-width: 800px;
            width: 100%;
            padding: 15px;
        }

        .video-container {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            background: #000;
        }

        video {
            width: 100%;
            display: block;
        }

        .vid-info {
            padding: 10px;
            margin-top: -8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        h1 {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
            line-height: 1.2;
        }

        #desc {
            font-size: 14px;
            color: #555;
            margin-bottom: 1.2rem;
            text-align: justify
        }

        #price {
            color: #27ae60;
            font-size: 20px;
            font-weight: bold;
        }

        .div-foot {
            margin: 5px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 2px solid rgba(104, 104, 104, 0.25);
            padding-top: 10px;
        }

        .foot {
            font-size: 16px;
            font-weight: 400;
            padding: 5px;
        }

        .div-btn {
            display: flex;
            width: 10rem;
            margin: 0 0 20px;
            border: 1px solid #333;
            border-radius: 50px;
            padding: 8px;
            gap: 0;
            justify-content: center;
            align-items: center;
        }

        .thumbs {
            margin: 0 auto;
            border: none;
            background-color: transparent;
            font-size: 18px;
            color: #333;
            cursor: pointer;
            transition: color 0.3s;
        }

        .thumbs:hover {
            color: #27ae60;
        }

        .feedback {
            margin-top: 20px;
            text-align: center;
        }

        .feedback h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .feedback textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            resize: vertical;
        }

        .feedback button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: rgb(36, 143, 214);
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .feedback button:hover {
            background-color: rgb(46, 124, 189);
        }

        .token-info {
            flex: 1;
            padding: 15px;
        }

        .token-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .token-container h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }

        .token-container ul {
            list-style: none;
            padding: 0;
        }

        .token-container ul li {
            margin-bottom: 8px;
            font-size: 16px;
            color: #555;
        }

        .token-container label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
        }

        .token-container input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        .token-container input:focus {
            border-color: #27ae60;
        }

        .token-container .btn {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: white;
            background: #27ae60;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .token-container .btn:hover {
            background: #219150;
        }

        .comment-section {
            border: 2px solid #555;
            margin-top: 15px;
            padding: 10px;
            border-top: 1px solid #ddd;
            max-width: 500px;
            height: 300px;
            overflow: auto;
            background-color: white;
        }

        .comment {
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 5px;
            background: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .comment strong {
            font-size: 1.1em;
            color: #333;
        }

        .comment p {
            margin: 5px 0;
            color: #555;
        }

        .comment small {
            color: #777;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 30px;
            }

            .video-sec,
            .token-container {
                max-width: 100%;
            }

            .token-container {
                text-align: left;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <section class="video-sec">
        <div class="video-container">
            <?php if (!empty($video) && file_exists($_SERVER['DOCUMENT_ROOT'] . "/Server/Code/zProject/Course Seller/Admin/Manage Course/" . $video)): ?>
                    <video controls autoplay>
                    <source src="<?php echo htmlspecialchars('/Server/Code/zProject/Course Seller/Admin/Manage Course/' . $video); ?>" type="video/mp4">
                <?php else: ?>
                    <p style="color: red; font-size: large; text-align: center; height: 400px;">⚠ Video file not found.</p>
            <?php endif; ?>
        </div>
        <div class="vid-info">
            <h1><?php echo $title; ?></h1>
            <p id="desc"><?php echo $desc; ?></p>
            <div class="div-foot">
                <p id="price" class="foot" title="Tokens">tks: <?php echo $price; ?></p>
                <p class="foot">Uploaded on: <?php echo $date; ?></p>
            </div>
        </div>

        <div class="feedback">
            <h3>Leave a Comment</h3>
            <form id="comment-form" method="POST" action="submit_comment.php">
                <textarea name="comment" placeholder="Write your comment here..." required></textarea>
                <input type="hidden" name="video_id" value="<?php echo $video_id; ?>">
                <button type="submit" class="btn">Submit Comment</button>
            </form>
        </div>
        <div id="comments-section">
            <h3>Comments</h3>
            <div id="comments-list">
                <!-- Comments will be loaded here -->
            </div>
        </div>
    </section>

    <section class="token-info">
        <div class="token-container">
            <h2>Token Information</h2>
            <ul>
                <li><strong>Price:</strong> ₹<?php echo $price; ?></li>
                <li><strong>Tokens you have:</strong> <?php echo $price; ?> Tokens</li>
            </ul>
            <form action="process_tokens.php" method="POST">
                <label for="tokens">Enter Tokens:</label>
                <input type="number" id="tokens" name="tokens" placeholder="Enter the number of tokens" required>
                <button type="submit" class="btn"><i class="fa-solid fa-coins"></i> Redeem Tokens</button>
            </form>
        </div>
    </section>
</div>
<?php require_once 'fetch_course.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        loadComments();

        $('#comment-form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/server/Code/zProject/Course%20Seller/Admin/Manage%20Course/course%20media/submit_comment.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response === "success") {
                        loadComments(); 
                        $('#comment-form textarea').val(''); 
                    } else {
                        alert("Error submitting comment.");
                    }
                },
                error: function () {
                    alert("An error occurred. Please try again.");
                }
            });
        });

        function loadComments() {
            $.ajax({
                url: 'http://localhost/server/Code/zProject/Course%20Seller/Admin/Manage%20Course/course%20media/fetch_comment.php',
                type: 'GET',
                data: { video_id: <?php echo $video_id; ?> },
                success: function (data) {
                    $('#comments-list').html(data); 
                },
                error: function () {
                    alert("Error loading comments.");
                }
            });
        }
    });
</script>
</body>
</html>