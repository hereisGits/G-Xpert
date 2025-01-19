<?php
session_start();

require_once './Manage users/Connection/db_connection.php';

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ./Authorize/login/Admin_login.php');
    exit;
} elseif (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_cookie'])) {
    $_SESSION['username'] = $_COOKIE['admin_cookie'];

    $stmt = $connection->prepare('SELECT admin_id FROM admin_table WHERE username = ?');
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['admin_id'];
    }
    $stmt->close();
    $connection->close();
}
if (isset($_SESSION['admin_id'])) {
    $stmt = $connection->prepare("SELECT COUNT(*) AS total_users FROM user_table");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $_SESSION['total_users'] = $row['total_users'];
    }
    $stmt->close();
    $connection->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><i class="fa-solid fa-house"></i> Dashboard</li>
            <li><i class="fa-solid fa-user-gear"></i> Manage Users</li>
            <li><i class="fa-solid fa-book-open"></i> Manage Courses</li>
            <li><i class="fa-solid fa-square-poll-vertical"></i> Reports</li>
            <li><i class="fa-solid fa-gears"></i> Settings</li>
        </ul>
    </div>

    <header>
        <div class="content">
            <div class="head">
                <h1><span id="greet">Welcome, <?php echo ucfirst($_SESSION['username']); ?></span>
                    <div class="greet-div">
                        <div id="greeting" class="dateTime"></div>
                        <div id="dateTime" class="dateTime"></div>
                    </div></h1>
            
                <div class="account">
                    <div id="admin-acc">
                        <a href="./Profile/admin_Profile.html"><i class="fa-solid fa-user-tie"></i></a>
                        <span class="tooltip profile">Profile</span>
                    </div>
                    <div id="logout">
                        <a href="Authorize/logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        <span class="tooltip logout">Logout</span>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="content-placeholder">   
            <div class="row">
                <div class="stat-card bg-primary">
                    <h2>20</h2>
                    <p>Active Users</p>
                </div>
                <div class="stat-card bg-success">
                    <h2>12</h2>
                    <p>Active Courses</p>
                </div>
                <div class="stat-card bg-warning">
                    <h2><?php echo isset($_SESSION['total_users']) ? $_SESSION['total_users'] : '0'; ?></h2>
                    <p>Total Users</p>
                </div>
                <div class="stat-card bg-danger">
                    <h2>Rs. 5,200</h2>
                    <p>Total Revenue</p>
                </div>
            </div>
        </main> 
        
    <script src="Admin.js"></script>
</body>
</html>
