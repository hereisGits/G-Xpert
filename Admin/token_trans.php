<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './Manage users/Connection/db_connection.php';
require_once './Transactions/add_tokens.php';

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ./Authorize/login/Admin_login.php');
    exit;
}
$_SESSION['username'] = $_SESSION['username'] ?? 'Admin';  
$_SESSION['admin_id'] = $_SESSION['admin_id'] ?? '1';  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Admin</title>
    <link rel="stylesheet" href="Transactions/token_trans.css">
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

<div class="container">
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
        <form action="" method="POST">
            <h2 class="add_token">Add Tokens to User</h2>
            <label for="user_id">User Id:</label>
            <input type="number" name="user_id" required><br>
            <label for="tokens">Tokens to Add:</label>
            <input type="number" name="tokens" required><br>
            <label for="admin_id">Admin Id:</label>
            <input type="number" name="admin_id" value="<?php echo isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : ''; ?>" readonly><br>

            <button type="submit">Add Tokens</button>
        </form>
        
        <section class="trans_table">
            <table>
            <h2 class="add_token">User Tokens</h2>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Tokens Added</th>
                <th>Added by Admin</th>
                <th>Date Added</th>
            </tr>
            <?php
                $query = "SELECT * FROM manual_tkn_add ORDER BY date_added DESC";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['user_id']}</td>
                                <td>{$row['tokens_added']}</td>
                                <td>{$row['added_by_admin_id']}</td>
                                <td>{$row['date_added']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>No transactions found.</td></tr>";
                }
            ?>
            </table>
        </section>
    </main>
</div> 

<script src="Dashboard/Admin.js"></script>  
<script>
    const popup = document.querySelector('#status-div p'); 
    if (popup) {
        setTimeout(() => {
            popup.style.display = 'none';
        }, 5000);
    }
</script>

</body>
</html>
