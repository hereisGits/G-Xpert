<?php require_once 'update_profile.php'; 
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
    $success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
    
    // Clear session messages after displaying
    unset($_SESSION['message']);
    unset($_SESSION['success']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <link rel="stylesheet" href="setting_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php require_once '../head&foot/navebar.php'; ?>

    <div id="status-div">
        <?php if (!empty($message)) { ?>
            <p id="status" class="error"> <?php echo '<i class="fa-solid fa-triangle-exclamation"></i> ' . htmlspecialchars($message); ?> </p>
        <?php } elseif (!empty($success)) { ?>
            <p id="status" class="success"> <?php echo '<i class="fa-solid fa-check-circle"></i> ' . htmlspecialchars($success); ?> </p>
        <?php } ?>
    </div>

    <div class="settings-container">
        <h2>User Settings</h2>
        <div class="headinfo">
            <div  class="user_details">
                <div>
                <p class="profile">
                    <span class="profile_name"><?php echo $initials;?></span>
                </p>
                </div>
                <div class="userinfo">
                    <p><?php echo $first_name.' '. $last_name ?></p>
                    <p id="username"><?php echo $username?></p>
                </div>
            </div>
            <form action="../../Guest User/Authorize/Log in/Logout/logout.php" method="POST">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        
        <div class="tabs">
            <button class="tab active" onclick="switchTab('overview')">Overview</button>
            <button class="tab" onclick="switchTab('settings')">Settings</button>
        </div>

        <div id="overview" class="section active">
            <h3>Overview</h3>
            <p><strong>User ID:</strong> <?php echo $user_id; ?></p>
            <p><strong>Name:</strong> <?php echo $first_name . ' ' . $last_name; ?></p>
            <p><strong>Role:</strong> <?php echo 'User'; ?></p>
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Created At:</strong> <?php echo $created_at; ?></p>
            <p><strong>Updated At:</strong> <?php echo $updated_at; ?></p>
        </div>

        <div id="settings" class="section">
            <form action="" method="POST" enctype="multipart/form-data">
                
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="input-box" value="<?php echo $first_name; ?>" required>
                
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="input-box" value="<?php echo $last_name; ?>" required>
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="input-box" value="<?php echo $username; ?>" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="input-box" value="<?php echo $email; ?>" required>
                
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" class="input-box" placeholder="Enter new password">

                
                <label for="created_at">Created At:</label>
                <input type="text" id="created_at" name="created_at" value="<?php echo $created_at; ?>" required readonly>
                
                <label for="updated_at">Updated At:</label>
                <input type="text" id="updated_at" name="updated_at" value="<?php echo  $updated_at; ?>" required readonly>
                
                <button type="submit" class="saveChange">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        const popup = document.querySelector('#status-div p'); 
        if (popup) {
            setTimeout(() => {
                popup.style.display = 'none';
            }, 5000);
        }

        function switchTab(tabName) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(tabName).classList.add('active');
            
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelector(`[onclick="switchTab('${tabName}')"]`).classList.add('active');
        }
        
    </script>

    <?php require_once '../head&foot/footer.php';?>
</body>
</html>
