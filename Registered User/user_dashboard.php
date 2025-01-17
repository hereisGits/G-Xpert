<?php
session_start();


if (!isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
    header("Location: ../Guest User/Authorize/Log in/login.php");
    exit();
}

if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore G-Xpert: Your gateway to learning new skills and expanding your knowledge with online courses.">
    <title>Online Course - Learn New Things</title>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
     <?php
     require_once './head&foot/navebar.php';
    ?>

    <main>
        <section class="hero">
            <div id="pic-container">
                <img src="./Assets/user wallpaper.png" alt="wallpaper">
            </div>           
            <div class="hero-content">

                <h1>Discover Your Path to Success</h1>
                <p>Learn from industry experts and boost your skills with our curated courses.</p>
                <div class="hero-buttons">
                    <a href="#" class="btn-primary">Start Learning</a>
                    <a href="#" class="btn-secondary">Explore Courses</a>
                </div>
            </div>
        </section>

        <section>

        </section>
    </main>

    <?php 
        require_once './head&foot/footer.php';
    ?>
    
</body>
</html>
