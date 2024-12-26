<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>G-Xpert - Signup Page</title>
</head>
<body>
    <?php
        require_once 'signup_validate.php';
		require_once '../../Landing page/nav&footer/navebar.php';
	?>
    
    <div class="full-display">
        <div class="illustra">
            <img src="../../Elements/illustra.jpg" alt="Illustration" class="positioned-img">
        </div>
        
        <div class="signup-form">
            <h3 class="title">Sign-up Now</h3>
        <div class="msg">
        <?php if(isset($success)) : ?>
                <p class="success"><?php echo '<i class="fa-solid fa-circle-check"></i> ' .$success; ?></p>
            <?php endif ?>

            <?php if (isset($status)) : ?>
                <p class="status">
                         <?php echo '<i class="fa-solid fa-triangle-exclamation"></i> ' . htmlspecialchars($status); ?></p>
            <?php endif;?>  
        </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="input-fields">
                    <div class="name-fields">
                        <div class="first-name">
                            <label for="fname" class="ask">First Name</label>
                            <input type="text" id="fname" name="fname" placeholder="Enter your first name" 
                                   value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>">
                            <?php echo printErrorMsg($error, 'fname'); ?>
                        </div>
                        <div class="last-name">
                            <label for="lname" class="ask">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="Enter your last name" 
                                   value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>">
                            <?php echo printErrorMsg($error, 'lname'); ?>
                        </div>
                    </div>

                    <div class="username-field">
                        <label for="username" class="ask">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter username"
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        <?php echo printErrorMsg($error, 'username'); ?>
                    </div>

                    <div class="email-field">
                        <label for="email" class="ask">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <?php echo printErrorMsg($error, 'email'); ?>
                    </div>

                    <div class="password-field">
                        <label for="password" class="ask">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']): ''; ?>">
                        <?php echo printErrorMsg($error, 'password'); ?>
                    </div>

                    <div class="terms">
                        <div class="terms-conditions">
                            <input type="checkbox" id="terms" name="term&con">
                            <label for="term&con" id="accept">Accept <a href="#">terms and conditions</a></label>
                        </div>                                          
                        <?php echo printErrorMsg($error, 'term&con'); ?>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="submit-btn">Sign up</button>
                        <div class="login-option">
                            <span>Do you have an account? <a href="login.php">Log in</a></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
        require_once '../../Landing page/nav&footer/footer.php';
    ?>

</body>
</html>
