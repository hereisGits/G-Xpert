<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Audiowide:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  
</head>

<style> 
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .nav {
        width: 100%; 
        max-width: 1920px; 
        background-color: #ffffff; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        margin: 0 auto; 
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 20px 15px 20px; 
    }

    .logo img {
        height: 45px; 
    }

    .navbar {
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .chard i{
        font-size: 18px;
        color: #080808;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .chard i:hover {
        color: #229ed9;
    }

    .navbar ul {
        list-style: none;
        display: flex;
        gap: 50px;
    }

    .navbar ul li {
        font-size: 16px;
    }

    .navbar ul li a {
        align-items: center;
        font-size: 16px;
        text-decoration: none;
        color: #131313;   
        cursor: pointer;
    }

    #nav-txt, #cnav-txt{
        transition: color 0.3s ease-in-out text-decoration 0.3s ease-in-out;
    }

    #nav-txt:hover, #nav-txt:focus{
        color: #229ed9;
        text-decoration: underline;
    }

    #cnav-txt:hover,#cnav-txt:focus{
        color: #229ed9;
    }

    .search-div {
        justify-content: none;
        position: relative;
        align-items: center;
        display: flex;
        gap: 10px;
    }

    #search-icon{
        font-size: 16px;
        color: #333;
        background-color: #ffffff;
        border: 1px solid #333;
        border-radius: 15px;
        padding: 10px 10px 10px 15px;
    }

    #search{
        flex-wrap:nowrap;
        background-color: #ffffff;
        width: 500px;
        padding-left: 10px;
        font-size: 14px;
        color: #333;
        cursor: text;
        outline: none;
        border: none;
    }

    .buttons {
        display: flex;
        gap: 25px;
    }

    .buttons button {
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
    }
   
    .buttons #login{
        border: 1px solid #0c0c0c;
        color: #030303;
        background-color: #ffffff;
    }

    .buttons #login:hover{
        background-color: #0c0c0c;
        color: #ffffff;
    }

    .buttons #signup {
        background-color: #0c0c0c;
        color: #ffffff;
        border: 1px solid #0c0c0c;
    }

    .buttons #signup:hover{
        background-color: #ffffff;
        color: #0c0c0c;
    }

</style>

<body>
    <?php 
        $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Server/Code/zProject/Course Seller/User";
     ?>
<header>
    <div class="nav">
        <div class="logo">
            <a href="<?php echo $base_url; ?>/Landing%20page/landing_page.php">
                <img src="<?php echo $base_url; ?>/Landing%20page/nav&footer/logo/nav-logo.svg" alt="Logo">
            </a>
        </div>
        <div></div>
        <div></div>
        <nav class="navbar">
            <ul>
                <li><a href="#" id="cnav-txt">Courses <i class="fa-solid fa-chevron-down"></i></a></li>
            </ul>
        </nav>   

        <div class="chard">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
         
        <div class="search-div">
            <i id="search-icon" class="fa-solid fa-magnifying-glass">
                <input type="text" id="search" placeholder="Search Courses">
            </i>
        </div>  
        <nav class="navbar">
            <ul>
                <li><a href="<?php echo $base_url; ?>/Landing%20page/About%20us/about.php" id="nav-txt">About</a></li>
            </ul>
        </nav>   
        <div></div>            
        <div></div>            
        <div></div>            

        <div class="buttons">
            <button id="login">Login</button>
            <button id="signup">Signup</button>
        </div>
    </div>
</header>

    <script>
        const log = document.getElementById('login');
        const sign = document.getElementById('signup');

        log.addEventListener('click', () => {
            window.location.href = 'http://localhost/Server/Code/zProject/Course%20Seller/User/Authorize/login.php';
        });

        sign.addEventListener('click', () => {
            window.location.href = 'http://localhost/Server/Code/zProject/Course%20Seller/User/Authorize/sign_up.php';
        });

    </script>
</body>
</html>