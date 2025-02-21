<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/Server/Code/zProject/Course%20Seller/Admin/Manage%20users/manage_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" 
          integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" 
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>

<div class="user_content">
    <div class="title">
        <h1>Manage Users</h1>
        <p>Perform actions like view, suspend, and delete</p>
    </div>
    
    <div id="alertBox" class="alert"></div>

    <?php
    require_once './Connection/db_connection.php';
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
            if (isset($row['status']) && $row['status'] == 'suspended' && isset($row['suspended_until'])) {
                $timeDiff = strtotime($row['suspended_until']) - time();
                if ($timeDiff > 0) {
                    $daysLeft = floor($timeDiff / (60 * 60 * 24));
                    $hoursLeft = floor(($timeDiff % (60 * 60 * 24)) / (60 * 60));
                    $suspensionTimeLeft = "{$daysLeft} days {$hoursLeft} hours";
                } else {
                    $suspensionTimeLeft = "Suspension Expired";
                }
            }

            echo '<tr>
                    <td>' . $row['user_id'] . '</td>
                    <td>' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</td>
                    <td>' . htmlspecialchars($row['email']) . '</td>
                    <td>' . htmlspecialchars($row['username']) . '</td>
                    <td>' . htmlspecialchars($row['status'] ?? 'Active') . '</td>
                    <td class="actions">
                        <div class="icons";>
                        <span class="icon" title="Suspend" onclick="suspendUser(' . $row['user_id'] . ')"><i id="suspand" class="fa-solid fa-user-lock"></i></span>
                        <span class="icon" title="Delete"><a href="delete_user.php?id=' . $row['user_id'] . '" 
                            onclick="return confirm(\'Are you sure you want to delete this user?\');"><i id="delete" class="fa-solid fa-trash"></i></a></span>
                        </div>
                     </td>
                    <td id="suspensionTime' . $row['user_id'] . '">' . $suspensionTimeLeft . '</td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p style="text-align: center; color: #888;">No users found</p>';
    }

    $connection->close();
    ?>

</div>

<script>
    function suspendUser(userId) {
        fetch(`suspend_user.php?id=${userId}`)
            .then(response => response.json())
            .then(data => {
                const alertBox = document.getElementById('alertBox');
                if (data.success) {
                    document.getElementById(`suspensionTime${userId}`).innerText = "30 days 0 hours";
                    alertBox.textContent = "User suspended successfully!";
                    alertBox.className = "alert success";
                } else {
                    alertBox.textContent = "Failed to suspend user!";
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
</script>

</body>
</html>
