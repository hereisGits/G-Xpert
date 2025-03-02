<?php
session_start(); 

$connection = new mysqli('localhost', 'root', '', 'user_database');
if ($connection->connect_error) {
    die('Database Connection error!');
}

//for total course
$t_user_stmt = $connection->prepare("SELECT COUNT(*) AS total_users FROM user_table");
$t_user_stmt->execute();
$result = $t_user_stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['total_users'] = $row['total_users'];
}
$t_user_stmt->close();

//for active course
$ta_course_stmt = $connection->prepare('SELECT COUNT(*) AS active_course FROM courses');
$ta_course_stmt->execute();
$result = $ta_course_stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['active_courses'] = $row['active_course'];
}
$ta_course_stmt->close();

//for active user
$active_user_stmt = $connection->prepare("SELECT COUNT(*) AS active_users FROM user_table WHERE updated_at >= NOW() - INTERVAL 30 DAY");
$active_user_stmt->execute();
$result = $active_user_stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['active_users'] = $row['active_users'];
}
$active_user_stmt->close(); 
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
   :root {
    --stat-card-bg-color: #2e2e2e;
    --stat-card-hover-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
    --card-text-color: rgb(255, 255, 255);
    --blue-color: #3498db;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
    --transition-speed: 0.3s;
    --text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5); 
}

.row {
    padding: 20px 40px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.stat-card {
    background-color: var(--stat-card-bg-color);
    color: var(--card-text-color);
    border-radius: 15px;
    padding: 20px;
    width: 20%;
    min-width: 220px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform var(--transition-speed), box-shadow var(--transition-speed);
    cursor: pointer;
    position: relative; 
    overflow: hidden; 
}

.stat-card:hover {
    box-shadow: var(--stat-card-hover-shadow);
    transform: scale(1.05);
}

.stat-card h2 {
    font-size: var(28px);
    margin-bottom: 10px;
}

.stat-card p {
    font-size: 18px;
    text-shadow: var(--text-shadow);
}

.bg-primary { background-color: var(--blue-color); }
.bg-success { background-color: var(--success-color); }
.bg-warning { background-color: var(--warning-color); }
.bg-danger { background-color: var(--danger-color); }

.stat-card::after { 
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    opacity: 0;
    transition: opacity var(--transition-speed);
}

.stat-card:hover::after {
    opacity: 1; 
}

@media (max-width: 768px) {
    .row {
        flex-direction: column;
        align-items: center;
    }

    .stat-card {
        width: 100%; 
        max-width: 350px; 
        padding: 15px;
    }

    .stat-card:hover {
        transform: none; 
    }

    .stat-card h2 {
        font-size: 24px;
    }

    .stat-card p {
        font-size: 16px;
    }
}

</style>
</head>
<body>
    <div class="row">
        <div class="stat-card bg-primary">
            <h2><?php echo isset($_SESSION['active_users']) ? $_SESSION['active_users'] : '0'; ?></h2>
            <p>Active Users</p>
        </div>
        <div class="stat-card bg-success">
            <h2><?php echo isset($_SESSION['active_courses']) ? $_SESSION['active_courses'] : '0'; ?></h2>
            <p>Active Courses</p>
        </div>
        <div class="stat-card bg-warning">
            <h2><?php echo isset($_SESSION['total_users']) ? $_SESSION['total_users'] : '0'; ?></h2>
            <p>Total Users</p>
        </div>
        <div class="stat-card bg-danger">
            <h2>Rs. 0</h2>
            <p>Total Revenue</p>
        </div>
    </div>
</body>
</html>
