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
        
    footer {
        background-color: #1a1a1a;
        color: #fff;
    }

    footer a {
        color: #fff;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: #00c8ff;
    }

    .footer-container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
    }

    .footer-items {
        flex-wrap: wrap; 
        display: flex; 
        justify-content: space-around; 
        align-items: flex-start; 
        margin: 0 30px 30px 30px; 
        padding: 10px; 
    }

    .item {
        flex: 1 1 20%;
        margin: 10px;
        min-width: 200px;
    }

    .item h3 {
        font-size: 18px;
        margin: 18px 0 10px;
        color: #ffffff;
    }

    .item ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .item ul li {
        margin-bottom: 8px;
    }

    .item ul li a {
        font-size: 14px;
    }

    .contact-item {
        margin-bottom: 8px;
        font-size: 14px;
    }

    .contact-item a {
        color: #00c8ff;
    }

    .contact-item a:hover {
        color: #fff;
    }

    .contact-item.social-media h3 {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .contact-item.social-media .social-links, .fa-brands{
        color: #fff;
        font-size: 24px;
        display: flex;
        gap: 10px;
    }

    .contact-item.social-media a {
        position: relative;
        text-align: center;
        font-size: 14px;
        margin: 0 5px;
        text-decoration: none;
    }

    .footer-logo {
        display: flex;
        justify-content:space-between;
        align-items: center;
        border-top: 1px solid #333;
        padding: 10px 0;
    }

    .footer-logo img {
        max-width: 150px;
        margin-left: 30px;
    }

    .footer-logo p {
        font-size: 14px;
        color: #bbb;
        margin-top: 5px;
        margin-right: 30px;
    }

</style>

<body>
    <?php
         $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Server/Code/zProject/Course%20Seller/Guest%20User/";
    ?>

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
                <a href="<?php echo $base_url; ?>/Landing%20page/landing_page.php">
                <img src="<?php echo $base_url; ?>/Landing%20page/nav&footer/logo/footer-logo.svg" alt="Logo">
            </a>
                </div>            
                <div class="copyright">
                    <p>&copy; 2024 G-Xpert. All Rights Reserved.</p>
                </div>
            </div>
        </div>            
    </footer>
</body>
</html>