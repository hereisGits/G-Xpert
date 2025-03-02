<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/Server/Code/zProject/Course%20Seller/Admin/Manage%20users/manage_style.css">
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
    
    if (!isset($connection)) {
        die("Database connection error.");
    }
    
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
            $status = !empty($row['status']) ? $row['status'] : 'Active';

            if ($status == 'suspended' && !empty($row['suspended_until'])) {
                $timeDiff = strtotime($row['suspended_until']) - time();
                if ($timeDiff > 0) {
                    $daysLeft = floor($timeDiff / (60 * 60 * 24));
                    $suspensionTimeLeft = "{$daysLeft} days";
                } else {
                    $suspensionTimeLeft = "Suspension Expired";
                }
            }

            echo '<tr data-user-id="' . $row['user_id'] . '">
                    <td>' . $row['user_id'] . '</td>
                    <td>' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</td>
                    <td>' . htmlspecialchars($row['email']) . '</td>
                    <td>' . htmlspecialchars($row['username']) . '</td>
                    <td id="status' . $row['user_id'] . '">' . htmlspecialchars($status) . '</td>
                    <td class="actions">
                        <div class="icons">
                            <span class="icon" title="Suspend" onclick="openSuspendModal(' . $row['user_id'] . ')">
                                <i class="fa-solid fa-user-lock"></i> suspend
                            </span>
                            <span class="icon" title="Delete" onclick="deleteUser(' . $row['user_id'] . ')">
                                <i class="fa-solid fa-trash"></i> delete
                            </span>
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

<div id="suspendModal" class="modal">
    <div class="modal-content">
        <form id="suspendForm" action="suspend_user.php" method="POST">
            <label for="user_id"><span class="form-item">User ID:</span></label>
            <input type="number" id="modalUserId" name="user_id" required readonly>

            <label for="days"><span class="form-item">Days:</span></label>
            <input type="number" id="daysInput" name="days" min="0" required>

            <label for="hours"><span class="form-item">Hours:</span></label>
            <input type="number" name="hours" min="0">

            <button type="submit">Suspend User</button>
        </form>
    </div>
</div>

<script>
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
    
    function openSuspendModal(userId) {
        document.getElementById('modalUserId').value = userId;
        document.getElementById('suspendModal').style.display = 'flex';
        document.body.classList.add('modal-open');
    }

    function closeSuspendModal() {
        document.getElementById('suspendModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('suspendModal');
        if (event.target === modal) {
            closeSuspendModal();
        }
    }

    function suspendUser(userId) {
        let days = document.getElementById("daysInput").value;
        if (!days) {
            alert("Please enter the number of days.");
            return;
        }
        if (confirm(`Are you sure you want to suspend user ID=${userId}?`)) {
            fetch(`suspend_user.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `user_id=${userId}&days=${days}`
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('success')) {
                    document.getElementById(`status${userId}`).innerText = "Suspended";
                    document.getElementById(`suspensionTime${userId}`).innerText = `${days} days`;
                    alert('User suspended successfully!');
                } else {
                    alert('Error suspending user: ' + data);
                }
                closeSuspendModal();
            });
        }
    }
</script>
</body>
</html>
