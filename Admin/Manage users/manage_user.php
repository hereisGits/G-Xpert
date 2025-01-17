<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="manage_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" 
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="user_content">
        <div class="title">
            <h1>Manage Users</h1>
            <p>Perform operations such as view, modify, suspend & delete</p>
        </div>

        <?php
            require_once './Connection/db_connection.php';
            $query = $connection->prepare('SELECT * FROM user_table');
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                echo "<table>";
                echo '<tr>
                        <th class="id">User ID</th>
                        <th class="full-name">Full Name</th>
                        <th class="username">Username</th>
                        <th class="action">Action</th>
                      </tr>';
                      
                while ($row = $result->fetch_assoc()) {
                    echo '<tr> 
                            <td id = "id">' . $row['user_id'] . '</td>
                            <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                            <td>' . $row['username'] . '</td>                              
                            <td>
                                <div class="icons">
                                    <div class="icon">
                                        <i class="fa-solid fa-eye-slash"></i>
                                        <span class="tooltip view">View</span>
                                    </div>                                    
                                    <div class="icon">
                                        <i class="fa-solid fa-user-lock"></i>
                                        <span class="tooltip lock">Suspend</span>
                                    </div>
                                    <div class="icon">
                                        <a href="./Delete users/delete.php?id=' . $row['user_id'] . '" 
                                           onclick="return confirm(\'Are you sure you want to delete this user?\');">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        <span class="tooltip delete">Delete</span>
                                    </div>
                                </div>
                            </td>
                          </tr>';                                            
                }
                echo "</table>";
            } else {
                echo '<div class="empty">Data is not found</div>';
            }

            $connection->close();
        ?>    
    </div>
</body>
</html>
