<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'Profile/update_profile.php';

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ./Authorize/login/Admin_login.php');
    exit;
}

if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_cookie'])) {
    $cookie_username = htmlspecialchars($_COOKIE['admin_cookie'], ENT_QUOTES, 'UTF-8'); // Sanitize input
    
    $stmt = $connection->prepare('SELECT admin_id FROM admin_table WHERE username = ?');
    $stmt->bind_param('s', $cookie_username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['username'] = $cookie_username;
    }
    $stmt->close();
}

$_SESSION['username'] = $_SESSION['username'] ?? 'Admin';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile -Admin Panel</title>
    <link rel="stylesheet" href="Profile/Admin-profile.css">
    <link rel="stylesheet" href="Dashboard/Dash_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <div id="status-div">
        <?php if (!empty($message)) { ?>
            <p id="status" class="error"><?php echo '<i class="fa-solid fa-triangle-exclamation"></i> ' . htmlspecialchars($message); ?></p>
        <?php } elseif (!empty($success)) { ?>
            <p id="status" class="success"><?php echo '<i class="fa-solid fa-check-circle"></i> ' . htmlspecialchars($success); ?></p>
        <?php } ?>
    </div>

    <div class="sidebar">
      <h2>Admin Dashboard</h2>
      <ul>
        <li><a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
        <li><a href="manage_user.php"><i class="fa-solid fa-user-gear"></i> Manage Users</a></li>
        <li><a href="manage_course.php"><i class="fa-solid fa-book-open"></i> Manage Courses</a></li>        
        <li><a href="token_trans.php"><i class="fa-solid fa-coins"></i> Token Transactions</a></li>
        <li><a href="#"><i class="fa-solid fa-square-poll-vertical"></i> Reports</a></li>
        <li><a href="#"><i class="fa-solid fa-gears"></i> Settings</a></li>
      </ul>      
    </div>

    <header class="content">
        <div class="head">
          <div id="time"><div id="timeDate"></div></div>
            <h1>Welcome, <?php echo ucfirst(htmlspecialchars($_SESSION['username'])); ?></h1>
            <div class="account">
                <a href="profile.php" title="Profile" id="profile"><i class="fa-solid fa-user-tie"></i></a>
                <a href="Authorize/logout/logout.php" title="Logout" id="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </header>


<main id="dynamic-content">
    <div class="profile-container">
        <div class="info">
            <h2 style="text-align: center; margin:20px;">Profile Settings</h2>
        </div>
        <div class="profile-header">
            <img src="<?php echo $image ? $image : 'uploads/admin_1.jpg'; ?>" alt="Admin Picture">
            <div>
                <h2><?php echo $username; ?></h2>
                <p><?php echo ucfirst($role); ?></p>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active" data-tab="overview" onclick="switchTab('overview')">Overview</div>
            <div class="tab" data-tab="settings" onclick="switchTab('settings')">Settings</div>
        </div>

        <div id="overview" class="section active">
            <h3 class="detail">Overview</h3>

            <div class="detail">
                <span class="detail-label">Username: </span> <?php echo $username; ?>
            </div>
            <div class="detail">
                <span class="detail-label">Role: </span> <?php echo ucfirst($role); ?>
            </div>
            <div class="detail">
                <span class="detail-label">Join since: </span> <?php echo $created_at; ?>
            </div>
            <div class="detail">
                <span class="detail-label">Updated At: </span> <?php echo $updated_at; ?>
            </div>
        </div>

        <div id="settings" class="section">
            <h3>Settings</h3>
            <p class="detail">Manage your profile settings here.</p>

            <form action="" method="post" enctype="multipart/form-data" class="profile-form">
            <div class="profile-picture-container">
                <img id="profile-preview" src="<?php echo $image ? $image : 'default-profile.jpg'; ?>" alt="Profile Preview">
                <label for="profiles" class="upload-label" id="uploadLabel">
                    Upload <i class="fa-solid fa-cloud-arrow-up"></i>
                </label>
                <input type="file" name="profiles" id="profiles" accept="image/*" style="display: none;">
            </div>

                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
        
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter new password">
        
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="superAdmin" <?php echo ($role == 'superAdmin') ? 'selected' : ''; ?>>Super Admin</option>
                    <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?> disabled style="cursor:not-allowed">Admin</option>
                </select>

                <label for="created_at">Created At</label>
                <input type="text" name="created_at" id="created_at" value="<?php echo $created_at; ?>" readonly>

                <label for="updated_at">Updated At</label>
                <input type="text" name="updated_at" id="updated_at" value="<?php echo $updated_at; ?>" readonly>

                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </div>
    </div>
</main>
    <script src="Dashboard/Admin.js"></script>  
    <script src="Profile/admin_profile.js"></script>
</body>
</html>
