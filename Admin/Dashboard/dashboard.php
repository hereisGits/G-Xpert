<?php

if (isset($_SESSION['admin_id'])) {
    $stmt = $connection->prepare("SELECT COUNT(*) AS total_users FROM user_table");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $_SESSION['total_users'] = $row['total_users'];
    }
    $stmt->close();
    $connection->close();
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
    :root {
    --stat-card-bg-color: #2e2e2e;
    --stat-card-hover-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
    --card-text-color: rgb(255, 255, 255);
    --blue-color: #3498db;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
    --font-size-large: 28px;
}

.row {
    padding: 20px 40px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.stat-card {
    background-color: var(--stat-card-bg-color);
    color: var(--card-text-color);
    border-radius: 10px;
    padding: 20px;
    width: 20%;
    min-width: 220px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
    cursor: pointer;
}

.stat-card:hover {
    box-shadow: var(--stat-card-hover-shadow);
    transform: scale(1.05);
}

.stat-card h2 {
    font-size: var(--font-size-large);
    margin-bottom: 10px;
}

.stat-card p {
    font-size: 18px;
}

.bg-primary { background-color: var(--blue-color); }
.bg-success { background-color: var(--success-color); }
.bg-warning { background-color: var(--warning-color); }
.bg-danger { background-color: var(--danger-color); }

@media (max-width: 768px) {
    .row {
        flex-direction: column;
        align-items: center;
    }

    .stat-card {
        width: 100%; 
        max-width: 350px; 
        padding: 15px;
    }

    .stat-card:hover {
        transform: none; 
    }

    .stat-card h2 {
        font-size: 24px;
    }

    .stat-card p {
        font-size: 16px;
    }
}
</style>
</head>
<body>
    <div class="row">
        <div class="stat-card bg-primary">
            <h2>20</h2>
            <p>Active Users</p>
        </div>
        <div class="stat-card bg-success">
            <h2>12</h2>
            <p>Active Courses</p>
        </div>
        <div class="stat-card bg-warning">
            <h2><?php echo isset($_SESSION['total_users']) ? $_SESSION['total_users'] : '0'; ?></h2>
            <p>Total Users</p>
        </div>
        <div class="stat-card bg-danger">
            <h2>Rs. 5,200</h2>
            <p>Total Revenue</p>
        </div>
    </div>
</body>
</html>
