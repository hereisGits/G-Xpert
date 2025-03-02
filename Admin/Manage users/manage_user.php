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
    
    <div id="alertBox" class="alert" style="display: none; padding: 20px;"></div>

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

<script>
    // Function to unsuspend a user
    function unsuspendUser(userId) {
        if (confirm(`Are you sure you want to unsuspend user ID=${userId}?`)) {
            fetch(`./Supand%20users/unsuspend_user.php?id=${userId}`)
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Log the response for debugging
                    const alertBox = document.getElementById('alertBox');
                    if (data.includes('successfully')) {
                        // Update the UI to reflect the unsuspension
                        document.getElementById(`status${userId}`).innerText = "Active";
                        document.getElementById(`suspensionTime${userId}`).innerText = "Not Suspended";
                        alertBox.textContent = "User unsuspended successfully!";
                        alertBox.className = "alert success";
                    } else {
                        alertBox.textContent = "Failed to unsuspend user! " + data; // Append response data
                        alertBox.className = "alert error";
                    }
                    alertBox.style.display = "block";
                    // Hide the alert box after 5 seconds
                    setTimeout(() => alertBox.style.display = "none", 5000);
                })
                .catch(error => {
                    console.error(error);
                    alert("An error occurred. Please try again.");
                });
        }
    }

    // Function to suspend a user
    function suspendUser(userId) {
        if (confirm(`Are you sure you want to suspend user ID=${userId}?`)) {
            fetch(`./Supand%20users/suspand_user.php?id=${userId}`)
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Log the response for debugging
                    const alertBox = document.getElementById('alertBox');
                    if (data.includes('successfully')) {
                        // Update the UI to reflect the suspension
                        document.getElementById(`status${userId}`).innerText = "Suspended";
                        document.getElementById(`suspensionTime${userId}`).innerText = "30 days 0 hours";
                        alertBox.textContent = "User suspended successfully!";
                        alertBox.className = "alert success";
                    } else {
                        alertBox.textContent = "Failed to suspend user! " + data; // Append response data
                        alertBox.className = "alert error";
                    }
                    alertBox.style.display = "block";
                    // Hide the alert box after 5 seconds
                    setTimeout(() => alertBox.style.display = "none", 5000);
                })
                .catch(error => {
                    console.error(error);
                    alert("An error occurred. Please try again.");
                });
        }
    }

    // Function to delete a user
    function deleteUser(userId) {
        if (confirm(`Are you sure you want to delete user ID=${userId}?`)) {
            fetch(`./Remove users/delete.php?id=${userId}`)
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