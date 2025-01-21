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
                    <p>Learn, Grow, and Succeed with G-Xpert</p>
                    <button>Explore Courses</button>
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
                        <div class="stars">
                            <img src="../Elements/star.svg" alt="Star">
                            <img src="../Elements/star.svg" alt="Star">
                            <img src="../Elements/star.svg" alt="Star">
                            <img src="../Elements/haft-star.svg" alt="Half Star">
                        </div>
                        </div>
                    <p>Rating</p>
                </div>
            </section>

            <section class="course-categories">
                <h2>Explore<br> Online<br> Courses</h2>
                <div></div>
                <ul class="categories">
                    <li>Development</li>
                    <li>Arts & Design</li>
                    <li>Digital Marketing</li>
                    <li>Personal Development</li>
                    <li>Business</li>
                    <li>Health & Fitness</li>
                    <li>Music</li>
                    <li>Photography</li>
                    <li>Finance</li>
                    <li>Technology</li>
                    <li>More..</li>
                </ul>
            </section>


            <section class="team-chart">
                <h1 id="team">Our Team</h1>
                <div class="team-container">
                    <div class="team-member">
                        <img src="../Elements/male.jpg" alt="Team Member 1">
                        <h2>Gaurav</h2>
                        <p>Developer</p>
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
