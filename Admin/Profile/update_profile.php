<?php
session_start();
require_once '../Manage users/Connection/db_connection.php';

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['user_cookie'])) {
    header('Location: ../Authorize/login/Admin_login.php');
    exit;
}

$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_COOKIE['admin_cookie'];

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
    $message = "No admin profile found.";
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password']; 
    $role = htmlspecialchars($_POST['role']);

    $updated_at = date('Y-m-d H:i:s'); 

    // Handle profile image upload
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
                $message = "Error moving the uploaded file.";
                exit;
            }
        } else {
            $message = "Invalid file type.";
            exit;
        }
    } else {
        $profileImagePath = $image;
    }

    $query = 'UPDATE admin_table SET username = ?, role = ?, updated_at = ?';
    $params = [$username, $role, $updated_at];
    $types = 'sss';

    if (!empty($profileImagePath)) {
        $query .= ', profile_path = ?';
        $params[] = $profileImagePath;
        $types .= 's';
    }

    if (!empty($password)) {
        $hashedPassword = $password;
        $query .= ', password = ?';
        $params[] = $password;
        $types .= 's';
    }

    $query .= ' WHERE admin_id = ?';
    $params[] = $admin_id;
    $types .= 'i';

    $stmt = $connection->prepare($query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $success = 'Updated successfully';
    } else {
        $message = "Error updating profile: " . $stmt->error;
    }
}
?>
