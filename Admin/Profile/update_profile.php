<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './Manage users/Connection/db_connection.php';

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: /server/Code/zProject/Course%20Seller/Admin/Authorize/login/Admin_login.php');
    exit;
}

if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_cookie'])) {
    $_SESSION['admin_id'] = $_COOKIE['admin_cookie'];
}

$admin_id = $_SESSION['admin_id'] ?? '053';
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
    $new_username = htmlspecialchars(trim($_POST['username']));
    $new_password = trim($_POST['password']);
    $new_role = htmlspecialchars(trim($_POST['role']));
    $new_updated_at = date('Y-m-d H:i:s');

    $changes_made = false;

    // Handle file upload
    $profileImagePath = $image; // Default to existing image
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileTmpPath = $_FILES['profile']['tmp_name'];
        $fileName = basename($_FILES['profile']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file type and size
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
        }
        if ($_FILES['profile']['size'] > $maxFileSize) {
            die("File size exceeds the maximum limit of 5MB.");
        }

        $newFileName = 'admin_' . $admin_id . '_' . uniqid() . '.' . $fileExtension;
        $uploadFilePath = $uploadDir . $newFileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file
        if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
            $profileImagePath = $uploadFilePath;
            $changes_made = true; // File upload is a change
        } else {
            die("Error moving the uploaded file.");
        }
    }

    // Check for changes in username, role, or password
    if ($new_username !== $username || $new_role !== $role || !empty($new_password)) {
        $changes_made = true;
    }

    if (!$changes_made) {
        $_SESSION['info_message'] = 'No changes made yet';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    // Prepare changes and parameters
    $queryStr = 'UPDATE admin_table SET username = ?, role = ?, updated_at = ?';
    $params = [$new_username, $new_role, $new_updated_at];
    $types = 'sss';

    if (!empty($profileImagePath)) {
        $queryStr .= ', profile_path = ?';
        $params[] = $profileImagePath;
        $types .= 's';
    }

    if (!empty($new_password)) {
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $queryStr .= ', password = ?';
        $params[] = $hashedPassword;
        $types .= 's';
    }

    $queryStr .= ' WHERE admin_id = ?';
    $params[] = $admin_id;
    $types .= 'i';

    // Execute the update query
    $stmt = $connection->prepare($queryStr);
    if (!$stmt) {
        die("Failed to prepare statement: " . $connection->error);
    }

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        // Store success message in session
        $_SESSION['success_message'] = 'Updated successfully';

        // Redirect to prevent form resubmission
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        die("Error updating profile: " . $stmt->error);
    }
}

// Display success message if set
if (isset($_SESSION['success_message'])) {
    $success = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear the message after displaying
}

// Display info message if no changes are made
if (isset($_SESSION['info_message'])) {
    $message = $_SESSION['info_message'];
    unset($_SESSION['info_message']); // Clear the message after displaying
}
?>