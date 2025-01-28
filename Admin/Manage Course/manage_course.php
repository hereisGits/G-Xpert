<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Management System</title>
<link rel="stylesheet" href="manage_course.css">
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

    <div class="main-container">
        <div class="title">
            <h1>Upload Courses</h1>
            <p>Add and manage course details efficiently!</p>
        </div>
        <div  class="card">
            <div style="float: right; font-size: 25px; cursor: pointer; margin: 0 15px 15px;" id="closeButton"><i class="fa-solid fa-xmark"></i></div>
            <form id="uploadForm" method="POST" action="upload_course.php" enctype="multipart/form-data">
                <section class="media_items">
                        <label>Media:</label>
                        <label for="video" class="upload-label">Upload Video <i class="fa-solid fa-video"></i></label>
                        <input type="file" name="video" id="video" accept="video/*">
                        <video id="videoPreview" controls style="display: none; width: 100%;"></video>

                        <button type="submit">Upload</button>
                    </section>
                <section class="media_details">
                        <label for="courseTitle">Course Title:</label>
                        <input type="text" id="courseTitle" name="courseTitle" placeholder="Enter course title">
                        <div class="char-count">
                            Characters: <span id="charCount"> 0</span> / 20
                            <p id="T-error" class="error"> (Character limit exceeded!)</p>
                        </div>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" placeholder="Enter course description"></textarea>
                        <div class="char-count">
                            Characters: <span id="DecharCount"> 0</span> / 100
                            <p id="D-error" class="error"> (Character limit exceeded!)</p>
                        </div>

                        <label for="schedule">Schedule:</label>
                        <input type="datetime-local" id="schedule" name="schedule">
                    </section>
            </form>

        </div>

        <section class="card course-list">
            <h2>Available Courses</h2>
            <ul id="courseList"></ul>
        </section>
    </div>

    <script>
        document.getElementById("closeButton").addEventListener("click", () => {
             document.querySelector("#uploadForm").reset();
        });

        function setupCharCount(inputId, countId, errorId, maxChars) {
            const input = document.getElementById(inputId);
            const countDisplay = document.getElementById(countId);
            const errorDisplay = document.getElementById(errorId);

            input.addEventListener('input', (e) => {
                const charCount = e.target.value.length;
                if (charCount <= maxChars) {
                    errorDisplay.style.display = 'none';
                    countDisplay.textContent = charCount;
                } else {
                    e.target.value = e.target.value.substring(0, maxChars);
                    errorDisplay.style.display = 'block';
                }
            });
        }

        setupCharCount('courseTitle', 'charCount', 'T-error', 20);
        setupCharCount('description', 'DecharCount', 'D-error', 100);

        const videoInput = document.getElementById('video');
        const videoPreview = document.getElementById('videoPreview');

        videoInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const fileURL = URL.createObjectURL(file);
                videoPreview.src = fileURL;
                videoPreview.style.display = 'block';
            } else {
                videoPreview.style.display = 'none';
            }
        });


        const uploadForm = document.getElementById('uploadForm');
        const courseList = document.getElementById('courseList');

        uploadForm.addEventListener('submit', (event) => {
            event.preventDefault();

        const title = document.getElementById('courseTitle').value.trim();
        const description = document.getElementById('description').value.trim();
        const schedule = document.getElementById('schedule').trim();
        const videoFile = videoInput.files[0];
        const scheduleValue = new Date(schedule.value);
        const currentTime = new Date();

        if (!title) {
            alert('Please enter a course title.');
            document.getElementById('courseTitle').focus();
            return;
        }

        if (!description) {
            alert('Please enter a course description.');
            document.getElementById('description').focus();
            return;
        }

        if (scheduleValue <= currentTime) {
            alert('Please select a future schedule.');
            scheduleInput.focus();
            return;
        }
        
        if (!videoFile) {
            alert('Please upload a video.');
            videoInput.focus();
            return;
        }
        });
</script>
</body>
</html>
