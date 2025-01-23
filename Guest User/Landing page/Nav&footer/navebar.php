<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Responsive Navbar</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
<style>:root {
    --primary-color: #229ed9;
    --secondary-color: #333;
    --background-color: #ffffff;
    --hover-color: #0c0c0c;
    --font-family: 'Inter', sans-serif;    
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: var(--font-family);
    background-color: var(--background-color);
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
    background-color: var(--background-color);
}

.logo img {
    height: 40px;
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
  overflow: hidden;
  font-family: var(--font-family);
  display: flex;
  align-items: center;
  gap: 20px;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: var(--secondary-color); 
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  cursor: pointer;
}

.dropdown {
  float: left;
  overflow: hidden;
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
  transition: dropdown 0.5s ease;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 10px;
  background-color: var(--background-color); 
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.dropdown-content .header {
  background: var(--primary-color);
  padding: 8px;
  color: white;
  user-select: none;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.row{
    display: inline-block;
    padding: 10px;
}
.column {
  float: left;
  justify-content: space-between;
  padding: 15px;
  height: 200px;
}

.column a {
  float: none;
  color: black;
  padding: 5px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.column a:hover {
  background-color: #ddd;
}

.row:after {
  content: "";
  display: table;
  clear: both;
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
        display: none;
        position: absolute;
        top: 60px;
        right: 20px;
        flex-direction: column;
        background: var(--background-color);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px;
        width: 250px;
    }
    .navbar.active {
        display: flex;
    }
    .hamburger {
        display: block;
    }
}
</style>
</head>
<body>
    <header>
        <div class="nav">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="search-div">
                <input type="search" placeholder="Search Courses">
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
                                <div class="column">
                                <h3>Personal Development</h3>
                                <a href="#">Communication skill</a>
                                <a href="#">Leadership</a>
                                <a href="#">Habits Management</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-link">About</a>
                </div>
                <div class="buttons">
                    <button>Login</button>
                    <button>Signup</button>
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
