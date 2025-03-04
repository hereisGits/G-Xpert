<?php  
if(session_start() === PHP_SESSION_NONE){
    session_start();
}

require_once 'Manage Course/course media/upload_course.php';
if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_cookie'])) {
    header('Location: ./Authorize/login/Admin_login.php');
    exit;
}

if (!isset($_SESSION['admin_id']) && isset($_COOKIE['admin_cookie'])) {
    $stmt = $connection->prepare('SELECT admin_id FROM admin_table WHERE username = ?');
    $stmt->bind_param('s', $_COOKIE['admin_cookie']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['username'] = $_COOKIE['admin_cookie'];
    }
    $stmt->close();
}

$_SESSION['username'] = $_SESSION['username'] ?? 'Admin';

$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$success = isset($_SESSION['success']) ? $_SESSION['success'] : "";

unset($_SESSION['message']);
unset($_SESSION['success']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Admin Panel</title>
    <link rel="stylesheet" href="/Server/Code/zProject/Course%20Seller/Admin/Manage%20Course/manage_course.css">
    <link rel="stylesheet" href="Dashboard/Dash_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <div id="status-div">
        <?php if (!empty($message)) { ?>
            <p id="status" class="message"><?php echo '<i class="fa-solid fa-triangle-exclamation"></i> ' . htmlspecialchars($message); ?></p>
        <?php } elseif (!empty($success)) { ?>
            <p id="status" class="success"><?php echo '<i class="fa-solid fa-check-circle"></i> ' . htmlspecialchars($success); ?></p>
        <?php } ?>
    </div>

    <div class="sidebar">
      <h2>Admin Dashboard</h2>
      <ul>
        <li><a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
        <li><a href="manage_user.php"><i class="fa-solid fa-user-gear"></i> Manage Users</a></li>
        <li><a href="manage_course.php"><i class="fa-solid fa-book-open"></i> Manage Courses</a></li>
        <li><a href="#"><i class="fa-solid fa-square-poll-vertical"></i> Reports</a></li>
        <li><a href="#"><i class="fa-solid fa-gears"></i> Settings</a></li>
      </ul>      
    </div>

    <header class="content">
        <div class="head">
          <div id="time"><div id="timeDate"></div></div>
            <h1>Welcome, <?php echo ucfirst(htmlspecialchars($_SESSION['username'])); ?></h1>
            <div class="account">
                <a href="profile.php" title="Profile" id="profile"><i class="fa-solid fa-user-tie"></i></a>
                <a href="Authorize/logout/logout.php" title="Logout" id="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </header>

    <main id="dynamic-content">
        <div class="main-container">
            <div class="title">
                <h1>Manage Courses</h1>
                <p>Add, update, and delete course details efficiently!</p>
            </div>

            <!-- Dropdown for Course Actions -->
            <div class="action-dropdown">
                <div>
                    <label for="courseAction">Select Action:</label>
                    <select id="courseAction" name="courseAction">
                        <option value="upload" selected>Upload Course</option>
                        <option value="update">Update Course</option>
                        <option value="delete">Delete Course</option>
                    </select>
                </div>
                <div style="float: right; font-size: 25px; cursor: pointer; margin: 0 15px 15px;" id="closeButton">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <!-- Upload Course Form (Default) -->
            <div class="card" id="uploadFormContainer">
                <h2 style="text-align: center; margin: 1rem auto; color: #555;">Add Course</h2>
                <form id="uploadForm" method="POST" action="" enctype="multipart/form-data">
                    <section class="media_items">
                        <label>Media:</label>
                        <label for="video" class="upload-label">Upload Video <i class="fa-solid fa-video"></i></label>
                        <input type="file" name="video" id="video" accept="video/*">
                        <video id="videoPreview" controls style="display: none; width: 100%;"></video>
                        
                        <hr style="margin-top: 20px;">
                        <button type="submit" id="submit">Upload</button>                            
                    </section>

                    <section class="media_details">
                        <label for="courseTitle">Course Title:</label>
                        <input type="text" id="courseTitle" name="courseTitle" placeholder="Enter course title">
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="charCount"> 0</span> / 30</p>
                                <p id="T-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="courseTitle-error" class="error-message">Course title is required.</p>                                
                        </div>
                        
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" placeholder="Enter course description"></textarea>
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="DecharCount"> 0</span> / 100</p>
                                <p id="D-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="description-error" class="error-message">Description is required.</p>                         
                        </div>

                        <div class="price-box">
                            <div class="price">
                                <label for="price">Price:(Rs)</label>
                                <input type="number" id="price" name="price" placeholder="000.00">
                                <p id="max-char">Max-price: Rs. 2000</p>
                                <p id="price-error" class="error-message">Price is required.</p>
                            </div>
                            <div class="schedule">
                                <label for="schedule">Schedule:</label>
                                <input type="datetime-local" id="schedule" name="schedule">
                                <p id="schedule-error" class="error-message">Please select a future schedule.</p>
                            </div>
                        </div>
                    </section>
                </form>
            </div>

            <!-- Update Course Form (Hidden by Default) -->
            <div class="card" id="updateFormContainer" style="display: none;">
                <h2 style="text-align: center; margin: 1rem auto; color: #555;">Update Course</h2>
                <form id="updateForm" method="POST" action="" enctype="multipart/form-data">
                    <label for="courseId">Course ID:</label>
                    <input type="text" id="courseId" name="courseId" placeholder="Enter course ID to update" required>
                    <button type="button" id="fetchCourseDetails" style="margin-bottom: 3rem;">Fetch Details</button>
                
                    <section class="media_items">
                        <label>Media:</label>
                        <label for="video" class="upload-label">Upload Video <i class="fa-solid fa-video"></i></label>
                        <input type="file" name="video" id="video" accept="video/*">
                        <video id="updateVideoPreview" controls style="display: none; width: 100%;"></video>
                        
                        <hr style="margin-top: 20px;">
                        <button type="submit" id="submit">Update</button>                            
                    </section>

                    <section class="media_details">
                        <label for="courseTitle">Course Title:</label>
                        <input type="text" id="newCourseTitle" name="courseTitle" placeholder="Enter course title">
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="charCount"> 0</span> / 30</p>
                                <p id="T-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="courseTitle-error" class="error-message">Course title is required.</p>                                
                        </div>
                        
                        <label for="description">Description:</label>
                        <textarea id="newDescription" name="description" placeholder="Enter course description"></textarea>
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="DecharCount"> 0</span> / 100</p>
                                <p id="D-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="description-error" class="error-message">Description is required.</p>                         
                        </div>

                        <div class="price-box">
                            <div class="price">
                                <label for="price">Price:(Rs)</label>
                                <input type="number" id="newPrice" name="price" placeholder="000.00">
                                <p id="max-char">Max-price: Rs. 2000</p>
                                <p id="price-error" class="error-message">Price is required.</p>
                            </div>
                            <div class="schedule">
                                <label for="schedule">Schedule:</label>
                                <input type="datetime-local" id="newSchedule" name="schedule">
                                <p id="schedule-error" class="error-message">Please select a future schedule.</p>
                            </div>
                        </div>
                    </section>
                </form>
            </div>

            <!-- Delete Course Form (Hidden by Default) -->
            <div class="card" id="deleteFormContainer" style="display: none;">
                <h2 style="text-align: center; margin: 1rem auto; color: #555;">Delete Course</h2>
                <form id="deleteForm" method="POST" action="">
                    <label for="deleteCourseId">Course ID:</label>
                    <input type="text" id="deleteCourseId" name="deleteCourseId" placeholder="Enter course ID to delete" required>
                    <button type="submit">Delete Course</button>
                </form>
            </div>

            <section>            
                <h1 style="text-align: center; margin-top: 40px; padding: 20px;">🎓 Available Courses</h1>
                <?php require_once 'Manage Course/course media/fetch_course.php';?>            
            </section>
        </div>
    </main>
    
    <script src="Dashboard/Admin.js"></script>
    <script src="/Server/Code/zProject/Course Seller/Admin/Manage Course/manage_course.js"></script>
    <script>
        document.getElementById('courseAction').addEventListener('change', function () {
            const selectedAction = this.value;

            // Hide all forms
            document.getElementById('uploadFormContainer').style.display = 'none';
            document.getElementById('updateFormContainer').style.display = 'none';
            document.getElementById('deleteFormContainer').style.display = 'none';

            // Show the selected form
            if (selectedAction === 'upload') {
                document.getElementById('uploadFormContainer').style.display = 'block';
            } else if (selectedAction === 'update') {
                document.getElementById('updateFormContainer').style.display = 'block';
            } else if (selectedAction === 'delete') {
                document.getElementById('deleteFormContainer').style.display = 'block';
            }
        });

        document.getElementById('fetchCourseDetails').addEventListener('click', function () {
            const courseId = document.getElementById('courseId').value;

            if (!courseId) {
                alert("Please enter a valid Course ID.");
                return;
            }

            // Send AJAX request to fetch course details
            fetch(`fetch_course_details.php?courseId=${courseId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Populate form fields with fetched data
                        document.getElementById('newCourseTitle').value = data.courseTitle;
                        document.getElementById('newDescription').value = data.description;
                        document.getElementById('newPrice').value = data.price;
                        document.getElementById('newSchedule').value = data.schedule;

                        // Display the video (if available)
                        const videoPreview = document.getElementById('updateVideoPreview');
                        if (data.videoPath) {
                            videoPreview.src = data.videoPath;
                            videoPreview.style.display = 'block';
                        } else {
                            videoPreview.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error fetching course details:', error));
        });

        document.getElementById('updateForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            const formData = new FormData(this);

            fetch('update_course.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // Expect plain text response
            .then(data => {
                if (data === 'success') {
                    alert('Course updated successfully!');
                    window.location.reload(); // Refresh the page to reflect changes
                } else {
                    alert('Error updating course: ' + data);
                }
            })
            .catch(error => console.error('Error updating course:', error));
        });

        document.getElementById('deleteForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            const courseId = document.getElementById('deleteCourseId').value;

            if (!courseId) {
                alert("Please enter a valid Course ID.");
                return;
            }

            // Send AJAX request to delete the course
            fetch('delete_course.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `courseId=${courseId}`
            })
            .then(response => response.text()) // Expect plain text response
            .then(data => {
                if (data === 'success') {
                    alert('Course deleted successfully!');
                    window.location.reload(); // Refresh the page to reflect changes
                } else {
                    alert('Error deleting course: ' + data);
                }
            })
            .catch(error => console.error('Error deleting course:', error));
        });
    </script>
</body>
</html>