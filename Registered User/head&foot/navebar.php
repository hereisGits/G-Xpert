<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Server/Code/zProject/Course%20Seller";

    
    $connection = new mysqli('localhost', 'root', '', 'user_database');
    if(!$connection){
        die('Database Connection Error:' .$connection->connect_error);
    }
    $user_id = $_SESSION['user_id']; 
    $fetch_data = "SELECT first_name, last_name FROM user_table WHERE user_id = ?";
    $stmt = $connection ->prepare($fetch_data);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $initials = strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1));
    } else {
        $initials = "U"; //default user
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard Navbar</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Audiowide:wght@400&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
<style>
:root {
    --primary-color:rgb(21, 161, 226);
    --secondary-color: #333;
    --background-color: #ffffff;
    --hover-color: #0c0c0c;   
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    line-height: 1.6;
    background-color: var(--background-color);
}

#header {
    width: 100%;
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
    background-color: var(--background-color);
    z-index: 10;
    position: relative;
    top: 0;
    left: 0;
}

.nav {
    max-width: 1400px;
    width: 100%;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 20px;
}

.logo img {
    height: 40px;
}

.nav-items {
    display: flex;
    align-items: center;
    gap: 20px;
}

.search-div {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 20px;
    padding: 5px 10px;
    width: 300px;
}

.search-div input {
    border: none;
    outline: none;
    width: 100%;
    font-size: 14px;
    padding: 5px;
}

.search-div i {
    color: var(--secondary-color);
    cursor: pointer;
}

.navbar {
    display: flex;
    align-items: center;
    gap: 20px;
}

.navbar a {
    font-size: 16px;
    color: var(--secondary-color); 
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    cursor: pointer;
}

.navbar a:hover {
    color: var(--primary-color);
}


.dropdown {
    position: relative;
}

.dropdown .dropbtn {
    font-size: 16px;  
    border: none;
    outline: none;
    color: var(--secondary-color); 
    padding: 14px 16px;
    background-color: inherit;
    font: inherit;
    margin: 0;
    cursor: pointer;
    transition: color 0.3s ease-in;
}
.dropbtn:hover, .dropbtn:focus{
    color: var(--primary-color);
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: var(--background-color); 
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    right: 10px; 
    min-width: 200px; 
}

.dropdown-content .header {
    padding: 15px 15px 5px 15px;
    color: var(--secondary-color);
    user-select: none;
    border-bottom: 1px solid #ccc;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.row {
    display: flex;
    padding: 20px;
}

.column {
    width: 150px;
    flex: 1;
    width: 200px;
}

.column h3 {
    margin-top: -10px;
    margin-bottom: 15px;
}

.column a {
    color: black;
    padding: 5px;
    text-decoration: none;
    display: block;
    text-align: left;
    transition: all 0.3s ease-in-out;
}

.column a:hover {
    background-color:rgba(34, 159, 217, 0.1);
}

.buttons {
    display: flex;
    gap: 20px;
}

.buttons button {
    padding: 8px 16px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    background: var(--hover-color);
    border: 1px solid;
    color: #fff;
    cursor: pointer;
    transition: background 0.5s ease;
}

.buttons button:hover {
    background: none;
    color: var(--hover-color);
    border: 1px solid var(--hover-color);
}

.notify-bell i{
    font-size: 20px;
    transition: color 0.3s ease;
} 

.notify-bell i:hover, i:focus{
    color: var(--primary-color);
}

.profile-dropdown {
    padding: 10px 10px 15px;
    cursor: pointer; 
}

.profile_name {
    color: #fff;
    font-weight: 400;
    font-size: 14px; 
}


.profile-dropdown .profile-btn {
    border: none;
    outline: none;
    border-radius: 50%;
    padding: 10px;
    background-color: #0c0c0c;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
}

.profile-dropdown-content {
    display: none;
    position: absolute;
    background-color: var(--background-color);
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    top: 70px;
    right: 0;
    min-width: 200px;
    padding: 10px;
    border-radius: 5px;
}

.profile-dropdown-content a {
    color: black;
    padding: 10px;
    text-decoration: none;
    display: block;
    text-align: left;
    transition: all 0.3s ease-in-out;
}

.profile-dropdown-content a:hover {
    background-color:rgba(34, 159, 217, 0.1);
}

.profile-dropdown:hover .profile-dropdown-content {
    display: block;
}

.hamburger {
    display: none;
    font-size: 24px;
    cursor: pointer;
}

@media (max-width: 768px) {
    .search-div {
        display: none;
    }

    .navbar {
        position: absolute;
        top: 60px;
        right: 20px;
        flex-direction: column;
        background: var(--background-color);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        align-items: center;
        z-index: 2;
        display: none;
    }

    .navbar.active {
        display: flex;
        gap: 2px;
    }
    .dropdown{
        display: none;
    }

    .hamburger {
        display: block;
    }
}
</style>
</head>
<body>
<header id="header">
    <div class="nav">
        <div class="logo">
            <a href="<?php echo $base_url; ?>/Registered%20User/user_dashboard.php">
                <img src="<?php echo $base_url; ?>/Registered%20User/Assets/nav-logo.svg" alt="Logo">
            </a>
        </div>
        <div class="nav-items">
            <div class="search-div">
                <input type="search" placeholder="Search...">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="hamburger">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="navbar">                
            <div class="dropdown">
                   <button class="dropbtn">Courses
                       <i class="fa fa-caret-down"></i>
                   </button>
                   <div class="dropdown-content">
                       <div class="header">
                           <h2>Our Courses</h2>
                       </div>   
                       <div class="row">
                           <div class="column">
                               <h3>Programming</h3>
                               <a href="#">Javscript</a>
                               <a href="#">Python</a>
                               <a href="#">Java</a>
                           </div>
                           <div class="column">
                               <h3>Design</h3>
                               <a href="#">Graphic Design</a>
                               <a href="#">UI/UX</a>
                               <a href="#">Web Design</a>
                           </div>
                           <div class="column">
                               <h3>Marketing </h3>
                               <a href="#">Digital Marketing</a>
                               <a href="#">SEO</a>
                               <a href="#">Content Marketing</a>
                           </div>
                       </div>
                   </div>
                </div>
                <a href="#">Support</a>
                <a href="<?php echo $base_url; ?>/Registered%20User/About us/about_us.php">About</a>
                <a href="#" class="notify-bell" title="message"><i class="fa-regular fa-bell"></i></a>
                <div class="profile-dropdown">
                    <button class="profile-btn"><span class="profile_name"><?php echo $initials;?></span></button>
                    <div class="profile-dropdown-content">
                        <a href="#">Settings</a>
                        <a href="<?php echo $base_url;?>/Guest%20User/Authorize/Log%20in/Logout/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    const hamburger = document.querySelector('.hamburger');
    const navbar = document.querySelector('.navbar');
    
    hamburger.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
</script>
</body>
</html>
