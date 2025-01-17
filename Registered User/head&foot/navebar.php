<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    color: #333;
    line-height: 1.6;
    background-color: #f9f9f9;
}

header {
    width: 100%;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Navigation Bar */
.nav {
    margin: 0 auto;
    display: flex;
    max-width: 1400px;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    flex-wrap: wrap;
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 30px;
}

.nav-left .img img {
    width: 120px;
    height: auto;
}

.course-category p {
    font-size: 18px;
    color: #000;
    font-weight: 500;
    display: flex;
    align-items: center;
}

.course-category p i{
    padding-left: 10px;
}

/* Search Bar */
.search {
    display: flex;
    align-items: center;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 20px;
    width: 350px;
    padding: 12px;
    gap: 10px;
    transition: border-color 0.3s ease;
}

.search:hover {
    border-color: #000;
}

.search i {
    color: #666;
    padding-left: 10px;
}

.search input {
    border: none;
    outline: none;
    width: 100%;
    font-size: 14px;
    color: #333;
    background: transparent;
}

/* Navigation Right */
.nav-right {
    display: flex;
    align-items: center;
    gap: 50px;
    flex-wrap: wrap;
}

.nav-right .user-profile{
    display: flex;
    gap: 20px;
}

.nav-right a {
    color: #333;
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    transition: color 0.3s ease;
    align-items: center;
}

.nav-right a i:hover {
    color: #2424248f;
}

.nav-right i {
    width: 40px;
    height: auto;
    color: #333;
}

</style>
<body>
    <?php 
         $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Server/Code/zProject/Course%20Seller/Registered%20User/";
    ?>
    <header>
        <div class="nav">
            <div class="nav-left">
                <div class="img">
                    <a href="<?php echo $base_url; ?>user_dashboard.php">
                        <img src="<?php echo $base_url; ?>Assets/nav-logo.svg" alt="G-Xpert logo">
                    </a>
                </div>
                <div class="course-category">
                    <p>Courses <i class="fa-solid fa-caret-down"></i></p>
                </div>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" id="search" placeholder="Search for courses...">
                </div>
            </div>            
            <div class="nav-right">
                <div class="mycart">
                    <a href="cart.html" title="My Cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
                <div class="notify">
                    <a href="notifications.html" title="Notifications">
                        <i class="fa-solid fa-bell"></i>
                    </a>
                </div>
                <div class="user-profile">
                    <div class="profile">
                        <a href="profile.html" title="My Profile">
                            <i class="fa-solid fa-user"></i></p>
                        </a>
                    </div>
                    <div class="user-logout">
                        <a href="../Guest User/Authorize/Log in/Logout/logout.php" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </header>
</body>
</html>