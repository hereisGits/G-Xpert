<?php
    if(session_start() === PHP_SESSION_NONE){
        session_start();
    }
    
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
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users -Admin Panel</title>
    <link rel="stylesheet" href="/Server/Code/zProject/Course%20Seller/Admin/Manage%20users/manage_style.css">
    <link rel="stylesheet" href="Dashboard/Dash_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
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
    <div class="user_content">
        <div class="title">
            <h1>Manage Users</h1>
            <p>Perform actions like view, suspend, and delete</p>
        </div>
        
        <div id="alertBox" class="alert" style="display: none; padding: 20px;"></div>

    <?php
        require_once 'Manage users/Connection/db_connection.php';
        $query = $connection->prepare('SELECT * FROM user_table');
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Suspension Time</th>
                </tr>';

            while ($row = $result->fetch_assoc()) {
                $suspensionTimeLeft = "Not Suspended";
                $suspendedUntilTimestamp = null;

                if (isset($row['status']) && $row['status'] == 'suspended' && isset($row['suspended_until'])) {
                    $suspendedUntilTimestamp = strtotime($row['suspended_until']);
                    $timeDiff = $suspendedUntilTimestamp - time();
                    if ($timeDiff > 0) {
                        $daysLeft = floor($timeDiff / (60 * 60 * 24));
                        $hoursLeft = floor(($timeDiff % (60 * 60 * 24)) / (60 * 60));
                        $minutesLeft = floor(($timeDiff % (60 * 60)) / 60);
                        $suspensionTimeLeft = "{$daysLeft} days {$hoursLeft} hours {$minutesLeft} minutes";
                    } else {
                        $suspensionTimeLeft = "Suspension Expired";
                    }
                }

                echo '<tr data-user-id="' . $row['user_id'] . '">
                        <td>' . $row['user_id'] . '</td>
                        <td>' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</td>
                        <td>' . htmlspecialchars($row['email']) . '</td>
                        <td>' . htmlspecialchars($row['username']) . '</td>
                        <td id="status' . $row['user_id'] . '">' . htmlspecialchars($row['status']) . '</td>
                        <td class="actions">
                            <div class="icons">';

                if ($row['status'] === 'suspended') {
                    echo '<span class="icon" title="Unsuspend" onclick="unsuspendUser(' . $row['user_id'] . ')"><i id="unsuspend" class="fa-solid fa-user-check"></i></span>';
                } else {
                    echo '<span class="icon" title="Suspend" onclick="suspendUser(' . $row['user_id'] . ')"><i id="suspend" class="fa-solid fa-user-lock"></i></span>';
                }

                echo '<span class="icon" title="Delete" onclick="deleteUser(' . $row['user_id'] . ')"><i id="delete" class="fa-solid fa-trash"></i></span>
                            </div>
                        </td>
                        <td id="suspensionTime' . $row['user_id'] . '" data-suspended-until="' . $suspendedUntilTimestamp . '">' . $suspensionTimeLeft . '</td>
                    </tr>';
            }
            echo '</table>';
        } else {
            echo '<p style="text-align: center; color: #888;">No users found</p>';
        }

        $connection->close();
    ?>

    </div>
</main>

<script src="Dashboard/Admin.js"></script>
<script>
    function unsuspendUser(userId) {
        if (confirm(`Are you sure you want to unsuspend user ID=${userId}?`)) {
            fetch(`Manage users/Supand users/unsuspend_user.php?id=${userId}`)
                .then(response => response.text())
                .then(data => {
                    // console.log(data); 
                    const alertBox = document.getElementById('alertBox');
                    if (data.includes('successfully')) {
                      
                        document.getElementById(`status${userId}`).innerText = "Active";
                        document.getElementById(`suspensionTime${userId}`).innerText = "Not Suspended";
                        alertBox.textContent = "User unsuspended successfully!";
                        alertBox.className = "alert success";
                    } else {
                        alertBox.textContent = "Failed to unsuspend user! " + data; // Append response data
                        alertBox.className = "alert error";
                    }
                    alertBox.style.display = "block";
                    setTimeout(() => alertBox.style.display = "none", 5000);
                })
                .catch(error => {
                    console.error(error);
                    alert("An error occurred. Please try again.");
                });
        }
    }

    function suspendUser(userId) {
        if (confirm(`Are you sure you want to suspend user ID=${userId}?`)) {
            fetch(`Manage users/Supand users/suspand_user.php?id=${userId}`)
                .then(response => response.text())
                .then(data => {
                    // console.log(data); 
                    const alertBox = document.getElementById('alertBox');
                    if (data.includes('successfully')) {
                        document.getElementById(`status${userId}`).innerText = "Suspended";
                        document.getElementById(`suspensionTime${userId}`).innerText = "30 days 0 hours";
                        alertBox.textContent = "User suspended successfully!";
                        alertBox.className = "alert success";
                    } else {
                        alertBox.textContent = "Failed to suspend user! " + data; // Append response data
                        alertBox.className = "alert error";
                    }
                    alertBox.style.display = "block";
                    setTimeout(() => alertBox.style.display = "none", 5000);
                })
                .catch(error => {
                    console.error(error);
                    alert("An error occurred. Please try again.");
                });
        }
    }

    function deleteUser(userId) {
        if (confirm(`Are you sure you want to delete user ID=${userId}?`)) {
            fetch(`Manage users/Remove users/delete.php?id=${userId}`)
                .then(response => response.text())
                .then(data => {
                    const alertBox = document.getElementById('alertBox');
                    if (data.includes('User deleted successfully')) {
                        alertBox.textContent = "User deleted successfully!";
                        alertBox.className = "alert success";
                        alertBox.style.display = "block";
                        setTimeout(() => alertBox.style.display = "none", 5000);
                        document.querySelector(`tr[data-user-id='${userId}']`).remove();
                    } else {
                        alertBox.textContent = "Error deleting user! " + data;
                        alertBox.className = "alert error";
                        alertBox.style.display = "block";
                        setTimeout(() => alertBox.style.display = "none", 5000);
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("An error occurred. Please try again.");
                });
        }
    }

</script>
</body>
</html>