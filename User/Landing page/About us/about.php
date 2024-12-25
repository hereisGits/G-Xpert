<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - G-Xpert</title>
    <link rel="stylesheet" type="text/css" href="style-about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        require_once '../Nav&footer/navebar.php';
        ?>

    <div class="about-header">
            <h1>#About Us</h1>
    </div>

    <div class="container">
        <div class="content">
            <div class="article">
                <h2>Welcome to G-Xpert!</h2>
                <p>                   
                    Your go-to platform for easy, fun, and impactful learning. From tech skills to personal growth, 
                    we’ve got courses tailored to your goals. Learn at your own pace with engaging lessons, quizzes, 
                    and certificates to show off your achievements.
                </p>
                <p>
                    Connect with experts through live sessions, join discussions, and explore flexible options like free courses, 
                    subscriptions, or one-time payments. At G-Xpert, learning isn’t just about knowledge—it’s about transformation.
                     Let’s level up together!
                </p>
                <a href="courses#" class="button">Explore Courses</a>
            </div>

            <div class="mission-vision">
                <div class="mission">
                    <h2>Our Mission</h2>
                    <p>
                        Our mission is to provide accessible, high-quality education to learners worldwide, empowering them to achieve their personal 
                        and professional goals. We believe in lifelong learning and strive to create an inclusive platform for everyone.
                    </p>
                </div>
                <div class="vision">
                    <h2>Our Vision</h2>
                    <p>
                        Our vision is to create a world where everyone has access to quality education, empowering individuals to learn, grow, and achieve 
                        their dreams through innovative and affordable online courses.
                    </p>
                </div>
            </div>
        </div>

        <section class="team-chart">
            <h1 id="team">Our Team</h1>
            <div class="team-container">
                <div class="team-member">
                    <img src="../../Elements/male.jpg" alt="Team Member 1">
                    <h2>Gaurav</h2>
                    <p>CEO & Founder & Developer</p>
                </div>
                
                <div class="team-member">
                    <img src="../../Elements/female.jpg" alt="Team Member 2">
                    <h2>Sofia</h2>
                    <p>UI/UX Designer</p>
                </div>
            </div>
        </section>


        <section class="testimonials">
            <h1>What Our Clients Say</h1>
            <div class="testimonials-container">
                <div class="testimonial">
                    <p>"The team was professional and delivered on time. Highly recommended!"</p>
                    <h3>- Rahul Thakur</h3>
                </div>
                <div class="testimonial">
                    <p>"Their creativity and problem-solving skills are unmatched. Excellent work!"</p>
                    <h3>- Diraj Sharma</h3>
                </div>
                <div class="testimonial">
                    <p>"Outstanding experience from start to finish. Great collaboration!"</p>
                    <h3>- Nirsha Acharya</h3>
                </div>
            </div>
        </section>
        
    </div>

    <?php
        require_once '../Nav&footer/footer.php';
        ?>
        
</body>
</html>