<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage users</title>
    <link rel="stylesheet" href="mu_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="user_content">
        <div class="title">
            <h1>Manage Users</h1>
            <p>Perform operation such as view, modify, suspend & delete</p>
        </div>

        <?php

            $connection = new mysqli('localhost', 'root', '', 'user_database');
            if ($connection->connect_error) {
                die('Database Connection Error: ' . $connection->connect_error);
            }

            $query = $connection->prepare('SELECT * FROM user_table ');
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {

                echo "<table border = 1;>";
                    echo '<tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>';
                        
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr> 
                                <td>' . $row['user_id'] . '</td>
                                <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                                <td>' . $row['username'] . '</td>
                                <td>' . $row['email'] . '</td>
                                <td>' . $row['created_at'] . '</td>
                                <td>
                                    <div class="icons">
                                        <div class="icon">
                                            <i class="fa-solid fa-eye-slash"></i>
                                            <span class="tooltip view">View</span>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span class="tooltip modify">Modify</span>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-user-lock"></i>
                                            <span class="tooltip lock">Suspend</span>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-trash-can"></i>
                                            <span class="tooltip delete">Delete</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                        }
                        echo "</table>";
                    } else {
                    echo 'Data is not found';
                }
            $connection->close();
        ?>    
    </div>
</body>
</html>