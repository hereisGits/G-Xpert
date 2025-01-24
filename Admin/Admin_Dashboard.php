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

$_SESSION['username'] = 'admin';

// Default content for the dashboard
$contentFile = './Dashboard/dashboard.php';
if (isset($_GET['page'])) {
    $contentFile = $_GET['page'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="Admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#" data-page="./Dashboard/dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="#" data-page="./Manage users/manage_user.php"><i class="fa-solid fa-user-gear"></i> Manage Users</a></li>
            <li><a href="#" data-page="./Manage course/manage_course.html"><i class="fa-solid fa-book-open"></i> Manage Courses</a></li>
            <li><a href="#" data-page="./Reports/reports.php"><i class="fa-solid fa-square-poll-vertical"></i> Reports</a></li>
            <li><a href="#" data-page="./Settings/settings.php"><i class="fa-solid fa-gears"></i> Settings</a></li>
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
                        <a href="./Profile/admin_Profile.php"><i class="fa-solid fa-user-tie"></i></a>
                        <span class="tooltip profile">Profile</span>
                    </div>
                    <div id="logout">
                        <a href="Authorize/logout/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        <span class="tooltip logout">Logout</span>
                    </div>
                </div>
            </div>
        </header>


    <main id="dynamic-content" class="dynamic-content" >
        <?php include $contentFile; ?>
    </main>

    <script src="Admin.js"></script>
</body>
</html>
