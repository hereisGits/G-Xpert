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
}
$_SESSION['username'] = $_SESSION['username'] ?? 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel</title>
  <link rel="stylesheet" href="Admin-style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
</head>
<body>
  <?php 
    $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/Server/Code/zProject/Course%20Seller/Admin"; 
  ?>
<div class="container">
    <div class="sidebar">
      <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="#"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa-solid fa-user-gear"></i> Manage Users</a></li>
            <li><a href="#"><i class="fa-solid fa-book-open"></i> Manage Courses</a></li>
            <li><a href="#"><i class="fa-solid fa-square-poll-vertical"></i> Reports</a></li>
            <li><a href="#"><i class="fa-solid fa-gears"></i> Settings</a></li>
        </ul>
    </div>
    <header class="content">
        <div class="head">
            <h1>Welcome, <?php echo ucfirst($_SESSION['username']); ?></h1>
            <div class="account">
                <a href="./Profile/admin_Profile.php" title="Profile" id="profile"><i class="fa-solid fa-user-tie"></i></a>
                <a href="Authorize/logout/logout.php" title="Logout" id="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </header>

    <main id="dynamic-content">
        <?php include './Dashboard/dashboard.php'; ?>
    </main>
</div>

</body>
</html>

