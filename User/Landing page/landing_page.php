<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="landing_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Audiowide:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <title>G-Xpert Landing Page</title>
</head>
<body>
    <header>
        <div class="nav">
            <div class="logo">
                <a href="#" id="a">
                    <img src="../Elements/nav-logo.svg" alt="Logo">
                </a>
            </div>
            <div></div>
            <nav class="navbar">
                <ul>
                    <li><a href="#" id="nav-txt">Courses <i class="fa-solid fa-chevron-down"></i></a></li>
                </ul>
            </nav>   

            <div class="chard">
               <i class="fa-solid fa-cart-shopping"></i>
            </div>
             
            <div class="search-div">
                <i  id="search-icon" class="fa-solid fa-magnifying-glass"><input type="text" id="search" placeholder="Search Courses"></i>

            </div>  
            <nav class="navbar">
                <ul>
                    <li><a href="#" id="nav-txt">About</a></li>
                </ul>
            </nav>               
            <div></div>
            <div></div>    
            <div></div>       

            <div class="buttons">
                <button id="login">Login</button>
                <button id="signup">Sign Up</button>
            </div>
        </div>
    </header>

    <div class="container-main">    
        <main>
            <section class="hero">
                <div class="text_landing">
                    <h1>Unlock Your Potential</h1>
                    <p>– Learn, Grow, and Succeed with G-Xpert</p>
                    <button>Explore Courses</button>
                </div>               
                <div class="illustra">
                    <img src="../Elements/illustra-landing.jpg" alt="landing_page" class="position_img">
                </div>
            </section>

            <section class="statistics">
                <div class="stat">
                    <strong>1.2k+</strong>
                    <p>Members</p>
                </div>
                <div class="stat">
                    <strong>1k+</strong>
                    <p>Purchased</p>
                </div>
                <div class="stat">
                    <div class="star">
                        <strong>3.5</strong>
                        <img src="../Elements/star.svg" alt="Star">
                        <img src="../Elements/star.svg" alt="Star">
                        <img src="../Elements/star.svg" alt="Star">
                        <img src="../Elements/haft-star.svg" alt="Half Star">                                    
                    </div>
                    <p>Rating</p>
                </div>
            </section>

            <section class="course-categories">
                <h2>Explore Online Courses</h2>
                <div class="categories">
                    <span id="fd">Featured</span>
                    <span>Development</span>
                    <span>Arts & Design</span>
                    <span>Digital Marketing</span>
                    <span>Personal Development</span>
                </div>
            </section>
        </main>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-items">
                <div class="item">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="team.html">Our Team</a></li>
                        <li><a href="careers.html">Careers</a></li>
                        <li><a href="privacy.html">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="item">
                    <h3>Community</h3>
                    <ul>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="events.html">Events</a></li>
                        <li><a href="partners.html">Partners</a></li>
                    </ul>
                </div>
                <div class="item">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="help.html">Help Center</a></li>
                        <li><a href="faq.html">FAQs</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="item">
                    <h3>Contact Details</h3>
                    <div class="contact-item">
                        <strong>Email:</strong> <a href="mailto:support@gxpert.com"> support@gxpert.com</a>
                    </div>
                    <div class="contact-item">
                        <strong>Tel:</strong> <a href="tel:9824356450"> +1‑XX‑XXX</a>
                    </div>
                    <div class="contact-item social-media">
                        <h3>Follow Us:</h3>
                        <div class="social-links">
                            <a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-square-facebook"></i></a> 
                            <a href="https://www.twitter.com" target="_blank"><i class="fa-brands fa-square-twitter"></i></a> 
                            <a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-square-instagram"></i></a>
                            <a href="https://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-logo">
                <div class="logo">
                    <img src="../Elements/footer-logo.svg" alt="G-Xpert Logo">
                </div>            
                <div class="copyright">
                    <p>&copy; 2024 G-Xpert. All Rights Reserved.</p>
                </div>
            </div>
        </div>            
    </footer>

    <script src="landing_page.js"></script>
</body>
</html>
