<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="Ad_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require_once '../login/Connection/fatch_data.php'; ?>

    <div id="status">
        <?php if(!empty($message)) : ?>
            <p><?php echo '<i class="fa-solid fa-triangle-exclamation"></i> '. htmlspecialchars($message);?></p>
        <?php endif; ?>
    </div>

    <div class="login-container">
        <div class="admin-sec">
            <div class="icon"><i class="fa-solid fa-user-tie"></i></div>
            <p>Admin</p>
        </div>
       
        <form action="#" method="post">
            <input type="text" id="username" name="username" placeholder="Enter username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            <div class="title"><span class="error"><?php echo isset($error['username'])? $error['username'] : ''; ?></span></div>
            

            <input type="password" id="password" name="password" placeholder="Enter password">
            <div class="title"><span class="error"><?php echo isset($error['password'])? $error['password'] : ''; ?></span></div>
            

            <button type="submit">Login</button>
        </form>
    </div>

    <script src="Ad_script.js">

    </script>
</body>
</html>
