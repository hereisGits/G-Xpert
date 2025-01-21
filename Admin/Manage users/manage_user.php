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
<style>:root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --table-header-bg: #2c3e50;
    --table-row-bg: #ecf0f1;
    --table-hover-bg:rgba(185, 218, 255, 0.47);
    --icon-color: #34495e;
    --tooltip-bg: #333;
    --tooltip-text-color: #fff;
    --button-bg: #3498db;
    --button-hover-bg: #2980b9;
}

.user_content {
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    margin-top: 20px;
    padding: 20px 40px;
}

.title h1 {
    text-align: center;
    font-size: 24px;
    color: var(--primary-color);
    margin: 0;
}

.title p {
    text-align: center;
    font-size: 14px;
    color: #7f8c8d;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: var(--table-header-bg);
    color: #fff;
}

tr{
    transition: background-color 0.3s ease-in-out;
}

tr:hover {
    background-color: var(--table-hover-bg);
}

td {
    border-bottom: 1.5px solid #ddd;
}

.empty {
    text-align: center;
    color: #e74c3c;
    font-size: 18px;
}

.icons {
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.icon {
    position: relative;
    cursor: pointer;
    color: var(--icon-color);
    font-size: 18px;
}

.fa-eye-slash:hover {
    color: blue;
}

.fa-user-lock:hover{
    color: orange;    
}

.fa-trash-can:hover{
    color: red;
}

.tooltip {
    visibility: hidden;
    position: absolute;
    bottom: 30px;
    left: -10px;
    background-color: var(--tooltip-bg);
    color: var(--tooltip-text-color);
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    white-space: nowrap;
}

.tooltip::after{
    content: " ";
    position: absolute;
    bottom: -5px;
    left: 28%;
    transform: translateX(-50%);
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid var(--tooltip-bg);
}

.icon:hover .tooltip {
    visibility: visible;
}

a {
    text-decoration: none;
    color: inherit;
}

a:hover {
    color: var(--icon-hover-color);
}
</style>
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
