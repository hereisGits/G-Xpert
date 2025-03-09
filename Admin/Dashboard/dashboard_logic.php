<?php
$connection = new mysqli('localhost', 'root', '', 'user_database');
if ($connection->connect_error) {
    die('Database Connection error!');
}

//for total course
$t_user_stmt = $connection->prepare("SELECT COUNT(*) AS total_users FROM users_table");
$t_user_stmt->execute();
$result = $t_user_stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['total_users'] = $row['total_users'];
}
$t_user_stmt->close();

//for active course
$ta_course_stmt = $connection->prepare('SELECT COUNT(*) AS active_course FROM videos_table');
$ta_course_stmt->execute();
$result = $ta_course_stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['active_courses'] = $row['active_course'];
}
$ta_course_stmt->close();

//for active user
$active_user_stmt = $connection->prepare("SELECT COUNT(*) AS active_users FROM users_table WHERE updated_at >= NOW() - INTERVAL 30 DAY");
$active_user_stmt->execute();
$result = $active_user_stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $_SESSION['active_users'] = $row['active_users'];
}
$active_user_stmt->close(); 
$connection->close();
?>
