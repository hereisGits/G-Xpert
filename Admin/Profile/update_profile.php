<?php
session_start();
require_once '../Manage users/Connection/db_connection.php';

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: /server/Code/zProject/Course%20Seller/Admin/Authorize/login/Admin_login.php');
    exit;
}

if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_cookie'])) {
    $_SESSION['admin_id'] = $_COOKIE['admin_cookie'];
}

$admin_id = $_SESSION['admin_id'] ?? null;
if (!$admin_id) {
    die("Admin ID is missing.");
}

$query = $connection->prepare('SELECT admin_id, username, role, profile_path, created_at, updated_at FROM admin_table WHERE admin_id = ?');
$query->bind_param('i', $admin_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = htmlspecialchars($row['username']);
    $role = htmlspecialchars($row['role']);
    $image = htmlspecialchars($row['profile_path']);
    $created_at = htmlspecialchars($row['created_at']);
    $updated_at = htmlspecialchars($row['updated_at']);
} else {
    die("No admin profile found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password']; 
    $role = htmlspecialchars($_POST['role']);
    $updated_at = date('Y-m-d H:i:s'); 

    $profileImagePath = $image; 
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileTmpPath = $_FILES['profile']['tmp_name'];
        $fileName = basename($_FILES['profile']['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = 'admin_' . $admin_id . '.' . $fileExtension;
        $uploadFilePath = $uploadDir . $newFileName;

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                $profileImagePath = $uploadFilePath;
            } else {
                die("Error moving the uploaded file.");
            }
        } else {
            die("Invalid file type.");
        }
    }

    $queryStr = 'UPDATE admin_table SET username = ?, role = ?, updated_at = ?';
    $params = [$username, $role, $updated_at];
    $types = 'sss';

    if (!empty($profileImagePath)) {
        $queryStr .= ', profile_path = ?';
        $params[] = $profileImagePath;
        $types .= 's';
    }

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $queryStr .= ', password = ?';
        $params[] = $hashedPassword;
        $types .= 's';
    }

    $queryStr .= ' WHERE admin_id = ?';
    $params[] = $admin_id;
    $types .= 'i';

    $stmt = $connection->prepare($queryStr);
    if (!$stmt) {
        die("Failed to prepare statement: " . $connection->error);
    }
    
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $success = 'Updated successfully';
    } else {
        die("Error updating profile: " . $stmt->error);
    }
}
?>
