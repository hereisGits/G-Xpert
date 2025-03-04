<?php
session_start();
require_once 'Dashboard/dashboard_logic.php';

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ./Authorize/login/Admin_login.php');
    exit;
}

if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_cookie'])) {
    $stmt = $connection->prepare('SELECT admin_id FROM admin_table WHERE username = ?');
    $stmt->bind_param('s', $_COOKIE['admin_cookie']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['username'] = $_COOKIE['admin_cookie'];
    }
    $stmt->close();
}

$_SESSION['username'] = $_SESSION['username'] ?? 'Admin';

$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Server/Code/zProject/Course%20Seller/Admin";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard -Admin Panel</title>
  <link rel="stylesheet" href="Dashboard/Dash_style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
</head>
<body>
<div class="container">
    <div class="sidebar">
      <h2>Admin Dashboard</h2>
      <ul>
        <li><a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
        <li><a href="manage_user.php"><i class="fa-solid fa-user-gear"></i> Manage Users</a></li>
        <li><a href="manage_course.php"><i class="fa-solid fa-book-open"></i> Manage Courses</a></li>
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
      <div class="row">
          <div class="stat-card bg-primary">
              <h2><?= $_SESSION['active_users'] ?? 0; ?></h2>
              <p>Active Users</p>
          </div>
          <div class="stat-card bg-success">
              <h2><?= $_SESSION['active_courses'] ?? 0; ?></h2>
              <p>Active Courses</p>
          </div>
          <div class="stat-card bg-warning">
              <h2><?= $_SESSION['total_users'] ?? 0; ?></h2>
              <p>Total Users</p>
          </div>
          <div class="stat-card bg-danger">
              <h2>Rs. 0</h2>
              <p>Total Revenue</p>
          </div>
      </div>
    </main>
</div>
<script src="Dashboard/Admin.js"></script>
</body>
</html>
