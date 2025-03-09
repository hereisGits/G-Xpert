<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'Manage Course/upload_course.php';

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


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['courseAction'])) {
    $_SESSION['input'] = $_POST;
}
$input = $_SESSION['input'] ?? [];
unset($_SESSION['input']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - Admin Panel</title>
    <link rel="stylesheet" href="Manage Course/manage_course.css">
    <link rel="stylesheet" href="Dashboard/Dash_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <div id="status-div">
        <p id="success" style="display:none;"></p>
        <p id="error" style="display:none;"></p>
    </div>

    <div class="sidebar">
      <h2>Admin Dashboard</h2>
      <ul>
        <li><a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
        <li><a href="manage_user.php"><i class="fa-solid fa-user-gear"></i> Manage Users</a></li>
        <li><a href="manage_course.php"><i class="fa-solid fa-book-open"></i> Manage Courses</a></li>
        <li><a href="token_trans.php"><i class="fa-solid fa-coins"></i> Token Transactions</a></li>
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

            <div class="action-dropdown">
                <div>
                    <label for="courseAction">Select Action:</label>
                    <select id="courseAction" name="courseAction">
                        <option value="upload" <?php echo ($input['courseAction'] ?? '') === 'upload' ? 'selected' : ''; ?>>Upload Course</option>
                        <option value="update" <?php echo ($input['courseAction'] ?? '') === 'update' ? 'selected' : ''; ?>>Update Course</option>
                        <option value="delete" <?php echo ($input['courseAction'] ?? '') === 'delete' ? 'selected' : ''; ?>>Delete Course</option>
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
                        <label class="important-label">Media:</label>
                        <label for="video" class="upload-label">Upload Video <i class="fa-solid fa-video"></i></label>
                        <input type="file" name="video" id="video" accept="video/*">
                        <video id="videoPreview" controls style="display: none; width: 100%;"></video>
                        
                        <hr style="margin-top: 20px;">
                        <button type="submit" id="submit">Upload</button>                            
                    </section>

                    <section class="media_details">
                        <label for="courseTitle" class="important-label">Course Title:</label>
                        <input type="text" id="courseTitle" name="courseTitle" placeholder="Enter course title">
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="charCount"> 0</span> / 50</p>
                                <p id="T-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="courseTitle-error" class="error-message">Course title is required.</p>                                
                        </div>
                        
                        <label for="description" class="important-label">Description:</label>
                        <textarea id="description" name="description" placeholder="Enter course description"></textarea>
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="DecharCount"> 0</span> / 500</p>
                                <p id="D-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="description-error" class="error-message">Description is required.</p>                         
                        </div>

                        <div class="price-box">
                            <div class="price">
                                <label for="price" class="important-label">Token:(tks)</label>
                                <input type="text" id="price" name="price" placeholder="000.00">
                                <p id="max-char">Max-tokens: Rs. 2000</p>
                                <p id="price-error" class="error-message">Token is required.</p>
                            </div>
                            <div class="schedule">
                                <label for="schedule">Schedule:</label>
                                <input type="datetime-local" id="schedule" name="schedule">
                                <p id="schedule-error" class="error-message">Please select a future schedule.</p>
                            </div>
                        </div>

                        <div class="status-box">
                            <label for="status" class="important-label">Status:</label><br>
                            <select id="status" name="status" style="width: 100%; padding: 12px; margin-top: 15px">
                                <option value="">Choose status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <p id="status-error" class="error-message">Status is required.</p>
                        </div>

                        <div class="category-box">
                            <label for="category" class="important-label">Category:</label><br>
                            <select id="category" name="category" style="width: 100%; padding: 12px; margin-top: 15px">
                                <option value="">Choose Category</option>
                                <option value="Education">Education</option>
                                <option value="Development">Development</option>
                                <option value="Arts & Design">Arts & Design</option>
                                <option value="Digital Marketing">Digital Marketing</option>
                                <option value="Personal Development">Personal Development</option>
                                <option value="Business">Business</option>
                                <option value="Health & Fitness">Health & Fitness</option>
                                <option value="Music">Music</option>
                                <option value="Photography">Photography</option>
                                <option value="Finance">Finance</option>
                                <option value="Technology">Technology</option>
                            </select>
                            <p id="category-error" class="error-message">Category is required.</p>
                        </div>
                    </section>
                </form>
            </div>

           <!-- Update Course Form (Hidden by Default) -->
            <div class="card" id="updateFormContainer" style="display: none;">
                <h2 style="text-align: center; margin: 1rem auto; color: #555;">Update Course</h2>
                <form id="updateForm" method="POST" action="" enctype="multipart/form-data">
                    <label for="courseId" class="important-label">Course ID:</label>
                    <input type="text" id="courseId" name="courseId" placeholder="Enter course ID to update" required>
                    <button type="button" id="fetchCourseDetails" style="margin-bottom: 3rem;">Fetch Details</button>
                
                    <section class="media_items">
                        <label class="important-label">Media:</label>
                        <label for="video" class="upload-label">Upload Video <i class="fa-solid fa-video"></i></label>
                        <input type="file" name="video" id="video" accept="video/*">
                        <video id="updateVideoPreview" controls style="display: none; width: 100%;"></video>
                        
                        <hr style="margin-top: 20px;">
                        <button type="submit" id="submit">Update</button>                            
                    </section>

                    <section class="media_details">
                        <label for="courseTitle" class="important-label">Course Title:</label>
                        <input type="text" id="newCourseTitle" name="courseTitle" placeholder="Enter course title" value="<?php echo htmlspecialchars($input['courseTitle'] ?? ''); ?>">
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="charCount"> 0</span> / 30</p>
                                <p id="T-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="courseTitle-error" class="error-message">Course title is required.</p>                                
                        </div>
                        
                        <label for="description" class="important-label">Description:</label>
                        <textarea id="newDescription" name="description" placeholder="Enter course description"><?php echo htmlspecialchars($input['description'] ?? ''); ?></textarea>
                        <div class="error-div">
                            <div class="char-count">
                                <p>Characters: <span id="DecharCount"> 0</span> / 100</p>
                                <p id="D-error" class="error"> (Character limit exceeded!)</p>
                            </div>
                            <p id="description-error" class="error-message">Description is required.</p>                         
                        </div>

                        <div class="price-box">
                            <div class="price">
                                <label for="price" class="important-label">Token:(tks)</label>
                                <input type="number" id="newPrice" name="price" placeholder="000.00" value="<?php echo htmlspecialchars($input['price'] ?? ''); ?>">
                                <p id="max-char">Max-price: Rs. 2000</p>
                                <p id="price-error" class="error-message">Price is required.</p>
                            </div>
                            <div class="schedule">
                                <label for="schedule">Schedule:</label>
                                <input type="datetime-local" id="newSchedule" name="schedule"  value="<?php echo htmlspecialchars($input['schedule'] ?? ''); ?>">
                                <p id="schedule-error" class="error-message">Please select a future schedule.</p>
                            </div>
                        </div>

                        <div class="status-box">
                            <label for="newStatus" class="important-label">Status:</label>
                            <select id="newStatus" name="status" style="width: 100%; padding: 12px; margin-top: 15px">
                                <option value="">Choose status</option>
                                <option value="active" <?php echo ($input['status'] ?? '') === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo ($input['status'] ?? '') === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="category-box">
                            <label for="newCategory" class="important-label">Category:</label>
                            <select id="newCategory" name="category" style="width: 100%; padding: 12px; margin-top: 15px">
                                <option value="">Choose Category</option>
                                <option value="Education" <?php echo ($input['category'] ?? '') === 'Education' ? 'selected' : ''; ?>>Education</option>
                                <option value="Development" <?php echo ($input['category'] ?? '') === 'Development' ? 'selected' : ''; ?>>Development</option>
                                <option value="Arts & Design" <?php echo ($input['category'] ?? '') === 'Arts & Design' ? 'selected' : ''; ?>>Arts & Design</option>
                                <option value="Digital Marketing" <?php echo ($input['category'] ?? '') === 'Digital Marketing' ? 'selected' : ''; ?>>Digital Marketing</option>
                                <option value="Personal Development" <?php echo ($input['category'] ?? '') === 'Personal Development' ? 'selected' : ''; ?>>Personal Development</option>
                                <option value="Business" <?php echo ($input['category'] ?? '') === 'Business' ? 'selected' : ''; ?>>Business</option>
                                <option value="Health & Fitness" <?php echo ($input['category'] ?? '') === 'Health & Fitness' ? 'selected' : ''; ?>>Health & Fitness</option>
                                <option value="Music" <?php echo ($input['category'] ?? '') === 'Music' ? 'selected' : ''; ?>>Music</option>
                                <option value="Photography" <?php echo ($input['category'] ?? '') === 'Photography' ? 'selected' : ''; ?>>Photography</option>
                                <option value="Finance" <?php echo ($input['category'] ?? '') === 'Finance' ? 'selected' : ''; ?>>Finance</option>
                                <option value="Technology" <?php echo ($input['category'] ?? '') === 'Technology' ? 'selected' : ''; ?>>Technology</option>
                            </select>
                            <p id="category-error" class="error-message">Category is required.</p>
                        </div>
                    </section>
                </form>
            </div>

            <!-- Delete Course Form (Hidden by Default) -->
            <div class="card" id="deleteFormContainer" style="display: none;">
            <h2 style="text-align: center; margin: 1rem auto; color: #555;">Delete Course</h2>
                <form id="deleteForm">
                    <label for="deleteCourseId" class="important-label">Course ID:</label>
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
            document.getElementById('uploadFormContainer').style.display = 'none';
            document.getElementById('updateFormContainer').style.display = 'none';
            document.getElementById('deleteFormContainer').style.display = 'none';
            if (selectedAction === 'upload') {
                    document.getElementById('uploadFormContainer').style.display = 'block';
                } else if (selectedAction === 'update') {
                    document.getElementById('updateFormContainer').style.display = 'block';
                } else if (selectedAction === 'delete') {
                    document.getElementById('deleteFormContainer').style.display = 'block';
                }
        });
        
        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            fetch('Manage Course/upload_course.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);                
                if (data.trim() === 'success') {
                    document.getElementById('status-div').innerHTML = `<p id="success"><i class="fa-solid fa-check-circle"></i> Course uploaded successfully!</p>`;
                    this.reset(); 

                    setTimeout(() => {
                        document.getElementById('status-div').innerHTML = '';
                    }, 5000);
                } else {
                    document.getElementById('status-div').innerHTML = `<p id="error"><i class="fa-solid fa-triangle-exclamation"></i> ${data.replace('error:', '').trim()}</p>`;

                    setTimeout(() => {
                        document.getElementById('status-div').innerHTML = '';
                    }, 5000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while uploading the course.');
            });
        });
        
        document.getElementById('fetchCourseDetails').addEventListener('click', function () {
        const courseId = document.getElementById('courseId').value;

        if (!courseId) {
            alert("Please enter a valid Course ID.");
            return;
        }

        fetch(`Manage Course/update_course.php?courseId=${courseId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.text();
            })
            .then(data => {
                if (data.startsWith('error:')) {
                    document.getElementById('status-div').innerHTML = `<p id="error"><i class="fa-solid fa-triangle-exclamation"></i> ${data.replace('error:', '').trim()}</p>`;
                    setTimeout(() => {
                        document.getElementById('status-div').innerHTML = '';
                    }, 5000);
                } else {

                    const [courseTitle, description, price, schedule, status, category, video_path] = data.split('|');
                        document.getElementById('newCourseTitle').value = courseTitle || '';
                        document.getElementById('newDescription').value = description || '';
                        document.getElementById('newPrice').value = price || '';
                        document.getElementById('newSchedule').value = schedule || '';
                        document.getElementById('newStatus').value = status || '';
                        document.getElementById('newCategory').value = category || '';

                    // Handle video preview
                    const videoPreview = document.getElementById('updateVideoPreview');
                    if (video_path && video_path.trim() !== '') {
                        videoPreview.src = video_path;
                        videoPreview.style.display = 'block';
                    } else {
                        videoPreview.style.display = 'none';
                        alert("Video not found!");
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching course details:', error);
                alert('An error occurred while fetching course details.');
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('updateForm');
        const inputs = form.querySelectorAll('input, textarea, select');
        let isChanged = false;

        inputs.forEach(input => {
            input.addEventListener('input', () => {  
                isChanged = true;
            });
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault(); 
                if (!isChanged) {
                    alert('No changes yet.');
                    return;
                }

            const formData = new FormData(form);
            fetch('Manage Course/update_course.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.startsWith('error:')) {
                    document.getElementById('status-div').innerHTML = `<p id="error"><i class="fa-solid fa-triangle-exclamation"></i> ${data.replace('error:', '').trim()}</p>`;
                    setTimeout(() => {document.getElementById('status-div').innerHTML = ''; }, 5000);
                } else {
                    document.getElementById('status-div').innerHTML = `<p id="success"><i class="fa-solid fa-check-circle"></i> Update successful!</p>`;
                    form.reset();
                    setTimeout(() => {document.getElementById('status-div').innerHTML = ''; }, 5000);
                }
            })
            .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the course.');
            });
            });
        });

        document.getElementById('deleteForm').addEventListener('submit', function (e) { 
        e.preventDefault();

        const courseId = document.getElementById('deleteCourseId').value.trim();
        if (!courseId) {
            alert("Please enter a valid Course ID.");
            return;
        }

        if (confirm(`Are you sure you want to delete Course ID No. ${courseId}?`)) {
            fetch('Manage Course/delete_course.php', {
                method: 'POST',
                body: `video_id=${encodeURIComponent(courseId)}`
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === 'success') {
                    document.getElementById('status-div').innerHTML = `<p id="success"><i class="fa-solid fa-check-circle"></i> Update successful!</p>`;
                    form.reset();

                    setTimeout(() => {document.getElementById('status-div').innerHTML = ''; }, 5000);
                } else {
                    document.getElementById('status-div').innerHTML = `<p id="error"><i class="fa-solid fa-triangle-exclamation"></i> ${data.replace('error:', '').trim()}</p>`;
                    
                    setTimeout(() => {document.getElementById('status-div').innerHTML = ''; }, 5000);
                }
            })
            .catch(error => {
                alert('Error processing request: ' + error);
            });
        }
    });

    </script>
</body>
</html>