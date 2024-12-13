<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="Admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require_once './fatch-data_con.php'; ?>

    <div class="status">
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
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter username">
            <span class="error">
                <?php echo isset($error['username'])? $error['username'] : ''; ?>
            </span>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password">
            <span class="error">
                <?php echo isset($error['password'])? $error['password'] : ''; ?>
            </span>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
