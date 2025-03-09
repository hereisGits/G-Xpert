<?php 
    if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
        header('Location: ./Authorize/login/Admin_login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f3f4f6;
    margin: 0;
    padding: 0;
    color: #333;
}

.trans_table{
    border: 1px solid rgba(0, 0, 0, 0.29);;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

h2{
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border-radius: 8px;
    padding: 30px;
    font-size: 18px;
}


tr, th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}

td {
    font-size: 16px;
}
</style>
<body>
    <div class="trans_table">
        <h2>Token Transactions</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Course ID</th>
                <th>Course Price</th>
                <th>Pay Tokens</th>
                <th>Date</th>
            </tr>
            <?php
                require_once '../Manage users/Connection/db_connection.php';
                $query = "SELECT * FROM users_course_pay ORDER BY date DESC";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['user_id']}</td>
                                <td>{$row['course_id']}</td>
                                <td>{$row['course_price']}</td>
                                <td>{$row['pay_tokens']}</td>
                                <td>{$row['date']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No transactions found.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>