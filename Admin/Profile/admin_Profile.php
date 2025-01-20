<?php require_once 'update_profile.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="Admin-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="status-div">
        <?php if (!empty($message)) { ?>
            <p id="status" class="error"><?php echo '<i class="fa-solid fa-triangle-exclamation"></i> ' . htmlspecialchars($message); ?></p>
        <?php } elseif (!empty($success)) { ?>
            <p id="status" class="success"><?php echo '<i class="fa-solid fa-check-circle"></i> ' . htmlspecialchars($success); ?></p>
        <?php } ?>
    </div>


    <div class="profile-container">
        <div class="profile-header">
            <div class="nav">
                <img src="<?php echo $image ? $image : 'default-profile.jpg'; ?>" alt="Admin Picture">
                <div>
                    <h2><?php echo $username; ?></h2>
                    <p><?php echo ucfirst($role); ?></p>
                </div>
            </div>
            <div class="goback">
                <button onclick="history.back()">
                    <i class="fa-solid fa-angle-left"></i> Back
                </button>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active" data-tab="overview" onclick="switchTab('overview')">Overview</div>
            <div class="tab" data-tab="settings" onclick="switchTab('settings')">Settings</div>
        </div>

        <div id="overview" class="section active">
            <h3>Overview</h3>
            <div class="detail">
                <span class="detail-label">Username: </span> <?php echo $username; ?>
            </div>
            <div class="detail">
                <span class="detail-label">Role: </span> <?php echo ucfirst($role); ?>
            </div>
            <div class="detail">
                <span class="detail-label">Join since: </span> <?php echo $created_at; ?>
            </div>
            <div class="detail">
                <span class="detail-label">Updated At: </span> <?php echo $updated_at; ?>
            </div>
        </div>

        <!-- Settings Section -->
        <div id="settings" class="section">
            <h3>Settings</h3>
            <p>Manage your profile settings here.</p>
            <form action="" method="post" enctype="multipart/form-data" class="profile-form">
                <div class="profile-picture-container">
                    <img id="profile-preview" src="<?php echo $image ? $image : 'default-profile.jpg'; ?>" alt="Profile Preview">
                    <label for="profile" class="upload-label">Upload <i class="fa-solid fa-cloud-arrow-up"></i></label>
                    <input type="file" name="profile" id="profile" accept="image/*" style="display:none;">
                </div>

                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
        
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter new password">
        
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="superAdmin" <?php echo ($role == 'superAdmin') ? 'selected' : ''; ?>>Super Admin</option>
                    <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?> disabled>Admin</option>
                </select>

                <label for="created_at">Created At</label>
                <input type="text" name="created_at" id="created_at" value="<?php echo $created_at; ?>" readonly>

                <label for="updated_at">Updated At</label>
                <input type="text" name="updated_at" id="updated_at" value="<?php echo $updated_at; ?>" readonly>

                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="admin_profile.js"></script>
</body>
</html>
