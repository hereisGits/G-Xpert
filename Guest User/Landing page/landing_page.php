<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="landing_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Audiowide:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <title>Online Course  - Learn New Thing</title>
</head>
<body>

    <?php
        require_once './Nav&footer/navebar.php';
        ?>
    
    <main>
        <div class="container-main">    
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
                
                <section class="course-cards">
                    <div class="course-card">
                        <img src="" alt="Course 1">
                        <div class="course-info">
                            <h3>Web Development</h3>
                            <p>Learn to build websites from scratch with HTML, CSS, and JavaScript.</p>
                            <button>Enroll Now</button>
                        </div>
                    </div>
                    <div class="course-card">
                        <img src="" alt="Course 2">
                        <div class="course-info">
                            <h3>Graphic Design</h3>
                            <p>Master the art of visual communication with Adobe Illustrator and Photoshop.</p>
                            <button>Enroll Now</button>
                        </div>
                    </div>
                    <div class="course-card">
                        <img src="" alt="Course 3">
                        <div class="course-info">
                            <h3>Photography</h3>
                            <p>Learn to capture the perfect shot with our online photography course.</p>
                            <button>Enroll Now</button>
                        </div>
                    </div>
                
            </div>

        <div class="team-div">
            <section class="team-chart">
                <h1 id="team">Our Team</h1>
                <div class="team-container">
                    <div class="team-member">
                        <img src="../Elements/male.jpg" alt="Team Member 1">
                        <h2>Gaurav</h2>
                        <p>CEO & Founder & Developer</p>
                    </div>
                    
                    <div class="team-member">
                        <img src="../Elements/female.jpg" alt="Team Member 2">
                        <h2>Sofia</h2>
                        <p>UI/UX Designer</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php
        require_once './Nav&footer/footer.php'; 
    ?>

    <script src="landing_page.js"></script>
</body>
</html>
