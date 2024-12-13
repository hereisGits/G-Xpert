<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="landing_page.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Audiowide:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
</head>
<body>
    <div class="container-main">		
		<header class="navbar">            
				<div class="logo">
					<a href="" id="a">
						<img src="../Elements/logo.svg" alt="Logo">
					</a>
				</div>

				<nav class="nav_bar">
					<div id="hm">Home</div>
					<div id="cu" class="nav">					
							<ul id="main">
							    <li><span id="course">Courses <i class="fa-solid fa-caret-down"></i></span>
							        <ul>
							            <li class="genra">Development
							                <ul>
							                    <li><a href="#" id="web">Web Dev</a>
							                        <ul>
							                            <li class="genra">Frontend
							                                <ul>
							                                    <li><a href="#">HTML</a></li>
							                                    <li><a href="#">CSS</a></li>
							                                    <li><a href="#">JavaScript</a></li>
							                                    <li><a href="#">React</a></li>
							                                </ul>
							                            </li>
							                            <li class="genra">Backend
							                                <ul>
							                                    <li><a href="#">SQL</a></li>
							                                    <li><a href="#">PHP</a></li>
							                                    <li><a href="#">Java</a></li>
							                                    <li><a href="#">Python</a></li>
							                                </ul>
							                            </li>
							                        </ul>
							                    </li>
							                    <li><a href="#" id="web">Android Dev</a>
							                        <ul>
							                            <li><a href="#">XML</a></li>
							                            <li><a href="#">Kotlin</a></li>
							                            <li><a href="#">Jetpack</a></li>
							                            <li><a href="#">Java</a></li>
							                            <li><a href="#">python</a></li>
							                            <li><a href="#">dotNet</a></li>
							                            <li><a href="#">PHP</a></li>
							                            <li><a href="#">SQL</a></li>					                                     							                            
							                        </ul>
							                    </li>
							                </ul>
							            </li>
							            <li class="genra">Design & Art
							                <ul>
							                    <li><a href="#">UI/UX Design</a></li>
							                    <li><a href="#">Graphic Design</a></li>
							                    <li><a href="#">Creative Arts</a></li>
							                </ul>
							            </li>
							            <li class="genra">Digital Marketing
							                <ul>
							                    <li><a href="#">Affiliate Marketing</a></li>
							                    <li><a href="#">SEO</a></li>
							                    <li><a href="#">Advertising</a></li>
							                    <li><a href="#">Social Marketing</a></li>
							                </ul>
							            </li>
							            <li class="genra">Personal Development
							                <ul>
							                    <li><a href="#">Communication</a></li>
							                    <li><a href="#">Leadership</a></li>
							                    <li><a href="#">Learn Languages</a></li>
							                    <li><a href="#">Habits Management</a></li>
							                </ul>
							            </li>
							        </ul>
							    </li>
							</ul>
						</div>  
					<div id="community" class="cmt">Community</div>
					<div id="notify" class="notify">Access to login</div>					
					<div id="at" class="nav">About</div>
				</nav>
				
				<div class="auth-buttons">
					<button id="login">Login</button>
					<button id="signup">Sign Up</button>
				</div>
		</header>

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
			<div class="blue_nav"></div>

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
		
		<div class="footer">			
			<div class="footer-nav">
				<a href="#" id="fnav">Courses</a>
				<a href="#" id="fnav">Blog</a>
				<a href="#" id="fnav">About us</a>
			</div>
				
			<div class="footer-links">
					<div class="legal-links">
						<a href="../feedback&Report/feedback.php">Feedback</a>
						<span id="h-line">|</span>
						<a href="../feedback&Report/report.php">Report</a>	
						<span id="h-line">|</span>					
						<a href="..\privacy&policy\contract.html">Privacy & Policy</a>
					</div>
				<p class="copyright">© 2024 G-Expert. All rights reserved.</p>
			</div>
		</div>  	
	</div>

	<script src="landing_page.js"></script>
</body>
</html>