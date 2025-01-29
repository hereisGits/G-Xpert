<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management System</title>
    <link rel="stylesheet" href="manage_course.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        .error-input {
            border: 1.5px solid rgb(255, 83, 83);
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: -15px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
   <?php require_once 'upload_course.php';?>
    <div id="status-div">
        <?php if (!empty($message)) { ?>
            <p id="status" class="message"><?php echo '<i class="fa-solid fa-triangle-exclamation"></i> ' . htmlspecialchars($message); ?></p>
        <?php } elseif (!empty($success)) { ?>
            <p id="status" class="success"><?php echo '<i class="fa-solid fa-check-circle"></i> ' . htmlspecialchars($success); ?></p>
        <?php } ?>
    </div>

    <div class="main-container">
        <div class="title">
            <h1>Upload Courses</h1>
            <p>Add and manage course details efficiently!</p>
        </div>

        <div class="card">
            <div style="float: right; font-size: 25px; cursor: pointer; margin: 0 15px 15px;" id="closeButton">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <form id="uploadForm" method="POST" action="" enctype="multipart/form-data">
                <section class="media_items">
                    <label>Media:</label>
                    <label for="video" class="upload-label">Upload Video <i class="fa-solid fa-video"></i></label>
                    <input type="file" name="video" id="video" accept="video/*">
                    <video id="videoPreview" controls style="display: none; width: 100%;"></video>
                    <p id="video-error" class="error-message" style="display: none;">Please upload a video.</p>
                    <hr style="margin-top: 20px;">
                    <button type="submit" id="submit">Upload</button>                           
                </section>

                <section class="media_details">
                    <label for="courseTitle">Course Title:</label>
                    <input type="text" id="courseTitle" name="courseTitle" placeholder="Enter course title">
                        <div class="char-count">
                            Characters: <span id="charCount"> 0</span> / 20
                            <p id="T-error" class="error"> (Character limit exceeded!)</p>
                        </div>
                    <p id="courseTitle-error" class="error-message" style="display: none;">Course title is required.</p>
                    
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" placeholder="Enter course description"></textarea>
                    <div class="char-count">
                       Characters: <span id="DecharCount"> 0</span> / 100
                       <p id="D-error" class="error"> (Character limit exceeded!)</p>
                   </div>
                    <p id="description-error" class="error-message" style="display: none;">Description is required.</p>

                    <label for="schedule">Schedule:</label>
                    <input type="datetime-local" id="schedule" name="schedule">
                    <p id="schedule-error" class="error-message" style="display: none;">Please select a future schedule.</p>
                </section>
            </form>
        </div>
        <section class="card course-list">
            <h2>Available Courses</h2>
            <ul id="courseList"></ul>
        </section>
    </div>

    <script>
        const popup = document.querySelector('#status-div p'); 
        if (popup) {
            setTimeout(() => {
                popup.style.display = 'none';
            }, 5000);
        }
        document.getElementById("closeButton").addEventListener("click", () => {
            document.getElementById("uploadForm").reset();
            document.getElementById("videoPreview").style.display = "none";
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

        document.getElementById("video").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const videoPreview = document.getElementById("videoPreview");
            if (file) {
                videoPreview.src = URL.createObjectURL(file);
                videoPreview.style.display = "block";
            } else {
                videoPreview.style.display = "none";
            }
        });

        document.getElementById("uploadForm").addEventListener("submit", (event) => {
            let isValid = true;
            function validateInput(inputId, errorId) {
                const input = document.getElementById(inputId);
                const errorMessage = document.getElementById(errorId);
                if (!input.value.trim()) {
                    input.classList.add('error-input');
                    errorMessage.style.display = 'block';
                    isValid = false;
                } else {
                    input.classList.remove('error-input');
                    errorMessage.style.display = 'none';
                }
            }
            validateInput("courseTitle", "courseTitle-error");
            validateInput("description", "description-error");

            if (!document.getElementById("video").files.length) {
                document.getElementById("video-error").style.display = "block";
                isValid = false;
            }else{
                document.getElementById("video-error").style.display = "none";
            }

            if (!isValid) event.preventDefault();
        });
    </script>

</body>
</html>
