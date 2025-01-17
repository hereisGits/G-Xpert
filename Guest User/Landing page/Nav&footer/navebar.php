<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn new skills with our online courses. Explore various categories and enhance your knowledge.">
    <meta name="keywords" content="online courses, e-learning, skill development">
    <meta property="og:title" content="Online Course - Learn New Things">
    <meta property="og:description" content="Learn new skills with our online courses. Explore various categories and enhance your knowledge.">
    <meta property="og:image" content="logo.png">
    <title>Online Course - Learn New Things</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        :root {
            --primary-color: #229ed9;
            --secondary-color: #333;
            --background-color: #ffffff;
            --hover-color: #0c0c0c;
            --font-family: 'Inter', sans-serif;
            --primary-font-size: 16px;
            --secondary-font-size: 14px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            line-height: 1.6;
            background-color: var(--background-color);
        }

        header {
            width: 100%;
            background: var(--background-color);
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav {
            margin: 0 auto;
            max-width: 1400px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }


        .logo img {
            height: 45px;
        }

        .nav-items{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar {
            display: flex;
            gap: 20px;
        }

        .navbar ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: var(--secondary-color);
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar ul li a:hover {
            color: var(--primary-color);
            text-decoration: none;
        }

        .hamburger {
            display: none;
            cursor: pointer;
        }

        .hamburger i {
            font-size: 24px;
            color: var(--secondary-color);
        }

        .chard{
            margin: 0 auto;

        }
        .chard i {
            font-size: var(--primary-font-size);
            color: var(--secondary-color);
            transition: color 0.3s;
            cursor: pointer;
        }

        .chard i:hover {
            color: var(--primary-color);
        }

        .search-div {
            position: relative;
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 5px 10px;
        }

        .search-div input[type="search"] {
            font-size: 14px;
            width: 500px;
            padding: 5px 8px;
            outline: none;
            border: none;
        }

        .search-div i {
            align-items: center;
            left: 10px;
            top: 50%;
            color: var(--secondary-color);
            padding-left: 10px;
            cursor: pointer;
        }

        .buttons {
            display: flex;
            gap: 15px;
        }

        .buttons button {
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            border: 1px solid var(--hover-color);
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        #login {
            background: none;
            color: var(--hover-color);
        }

        #login:hover {
            background: var(--hover-color);
            color: var(--background-color);
        }

        #signup {
            background: var(--hover-color);
            color: var(--background-color);
        }

        #signup:hover {
            background: none;
            color: var(--hover-color);
        }

        @media (max-width: 768px) {
            .navbar ul {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                right: 20px;
                background: var(--background-color);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 10px;
                gap: 15px;
            }

            .search-div {
                position: relative;
                display: flex;
                align-items: center;
                transition: all 0.3s ease-in-out;
            }
            .search-div input[type="search"], i {
                width: 100px;
                padding: 8px;
                font-size: var(--secondary-font-size);
                border: 1px solid #ccc;
                border-radius: 20px;
                transition: width 0.3s ease-in-out;
                outline: none;
                border: none;
                overflow: hidden;
            }

            .search-div input[type="search"]:focus {
                width: 200px;
                padding: 8px 12px;
            }
            

            .navbar.active ul {
                display: flex;
            }

            .buttons{
                padding: 5px 10px;
                font-size: 14px;
                font-weight: bold;
                border-radius: 5px;
                cursor: pointer;
            }

            .hamburger {
                display: block;
            }
        }
    </style>
</head>
<body>
    <?php 
        $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Server/Code/zProject/Course%20Seller/Guest%20User/";
    ?>
    <header>
        <div class="nav">
            <div class="logo">
                <a href="<?php echo $base_url; ?>/Landing%20page/landing_page.php">
                    <img src="<?php echo $base_url; ?>/Landing%20page/nav&footer/logo/nav-logo.svg" alt="Logo">
                </a>
            </div>
            <div class="search-div">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" id="search" placeholder="Search Courses" aria-label="Search Courses">
            </div>           
                <nav class="navbar">
                    <div class="chard">
                        <a href="#" title="Add in Card">
                            <i class="fa-solid fa-cart-shopping" aria-label="Cart"></i>
                        </a>
                    </div>
                    <ul>
                        <li><a href="#" id="cnav-txt">Courses <i class="fa-solid fa-caret-down"></i></a></li>
                        <li><a href="<?php echo $base_url; ?>/Landing%20page/About%20us/about.php" id="nav-txt">About</a></li>
                    </ul>
                </nav>
            <div class="buttons">
                <button id="login">Login</button>
                <button id="signup">Signup</button>
            </div>
            <div class="hamburger">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>

    <script>
        const log = document.getElementById('login');
        const sign = document.getElementById('signup');
        const hamburger = document.querySelector('.hamburger');
        const navbar = document.querySelector('.navbar');

        log.addEventListener('click', () => {
            window.location.href = '<?php echo $base_url; ?>/Authorize/Log%20in/login.php';
        });

        sign.addEventListener('click', () => {
            window.location.href = '<?php echo $base_url; ?>/Authorize/Sign%20up/sign_up.php';
        });

        hamburger.addEventListener('click', () => {
            navbar.classList.toggle('active');
        });
    </script>
</body>
</html>
