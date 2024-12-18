<?php
session_start();

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ./Authorize/login/Admin_login.php  ');
    exit;
}

if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_cookie'])) {
    $_SESSION['username'] = $_COOKIE['admin_cookie'];

    $connection = new mysqli('localhost', 'root', '', 'user_database');
    if ($connection->connect_error) {
        die('Database connection error: ' . $connection->connect_error);
    }

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
        <div class="section"><i class="fa-solid fa-house"></i> Dashboard</div>
        <div class="section"><i class="fa-solid fa-user-gear"></i> Manage Users</div>
        <div class="section"><i class="fa-solid fa-book-open"></i> Manage Courses</div>
        <div class="section"><i class="fa-solid fa-square-poll-vertical"></i> Reports</div>
        <div class="section"><i class="fa-solid fa-gears"></i> Settings</div>
    </div>

    <div class="content">
        <div class="head">
            <h1>Welcome, <?php echo ucfirst($_SESSION['username']); ?></h1>
            <div class="account">
                <div id="admin-acc"><a href=""><i class="fa-solid fa-user-tie"></i></a></div>
                <div id="logout"><a href="Authorize/logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></div>
            </div>
        </div>
        <div class="row">
            <div class="stat-card bg-primary">
                <h2>120</h2>
                <p>Active Users</p>
            </div>
            <div class="stat-card bg-success">
                <h2>35</h2>
                <p>Active Courses</p>
            </div>
            <div class="stat-card bg-warning">
                <h2>15</h2>
                <p>Pending Requests</p>
            </div>
            <div class="stat-card bg-danger">
                <h2>$5,200</h2>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>

    <script src="Admin.js"></script>
</body>
</html>
