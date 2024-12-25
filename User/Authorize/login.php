<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="login.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  	<title>G-Xpert | Login Page</title>
</head>
<body>
	<?php
        require_once 'Login_validate.php';
		require_once '../Landing page/nav&footer/navebar.php';
    ?>

	<div class="full-display">
		<div class="illustra">
            <img src="../Elements/illustra-small.jpg"  alt="Illustration" class="positioned-img">
        </div>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

			<div class="login-form">
					<div class="title">
						<h2>Log in Now</h2>
					</div>				
					<?php if (!empty($status)) : ?>
						<p class="status"><?php echo '<i class="fa-solid fa-triangle-exclamation"></i> '. htmlspecialchars($status); ?></p>
					<?php endif; ?>

				<div class="input-fields">
					<div class="email-field">
						<label for="email" class="email-ask" id="label">Email</label>
						<input type="text" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
						<span class="error">
							<?php echo printErrorMsg($error, 'email'); ?>
						</span>
					</div>
					<div class="password-field">
						<label for="password" class="password-ask" id="label">Password</label>
						<input type="password" id="password" name="password" placeholder="Enter your password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
						<span class="error">
							<?php echo printErrorMsg($error, 'password'); ?>
						</span>
					</div>
					<div class="terms-conditions">
						<input type="checkbox" id="terms" name="remember">
						<label for="terms" id="remember">Remember me for 10 days</label>
					</div>
					<div class="form-buttons">
						<button type="submit" id="submit-btn" name="submit">Log in</button>

						<div class="login-option">
							<span>Don’t have an account? <a href="sign_up.php">Sign up</a></span>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<?php
		require_once '../Landing page/nav&footer/footer.php';
	?>

</body>
</html>
