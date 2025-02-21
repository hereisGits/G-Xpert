<?php  
session_start();
require_once 'course media/upload_course.php';
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
    <title>Course Management System</title>
    <link rel="stylesheet" href="/Server/Code/zProject/Course%20Seller/Admin/Manage%20Course/manage_course.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
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
                    
                    <hr style="margin-top: 20px;">
                    <button type="submit" id="submit">Upload</button>                            
                </section>

                <section class="media_details">
                    <label for="courseTitle">Course Title:</label>
                    <input type="text" id="courseTitle" name="courseTitle" placeholder="Enter course title" >
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
                            <input type="number" id="price" name="price" placeholder="000.00" >
                            <p id="max-char">Max-price: Rs. 2000</p>
                            <p id="price-error" class="error-message">Price is required.</p>
                        </div>
                        <div class="schedule">
                            <label for="schedule">Schedule:</label>
                            <input type="datetime-local" id="schedule" name="schedule" >
                            <p id="schedule-error" class="error-message">Please select a future schedule.</p>
                        </div>
                    </div>
                </section>
            </form>
        </div>

        <section>            
            <h1 style="text-align: center; margin-top: 40px; padding: 20px;">🎓 Available Courses</h1>
            <?php require_once 'course media/fetch_course.php';?>            
        </section>
    </div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const popup = document.querySelector('#status-div p'); 
    if (popup) {
        setTimeout(() => popup.style.display = 'none', 5000);
    }

    document.getElementById("closeButton").addEventListener("click", () => {
        document.getElementById("uploadForm").reset();
        document.getElementById("videoPreview").style.display = "none";
    });

    function setupCharCount(inputId, countId, errorId, maxChars) {
        const input = document.getElementById(inputId);
        const countDisplay = document.getElementById(countId);
        const errorDisplay = document.getElementById(errorId);

        input.addEventListener('input', () => {
            const charCount = input.value.length;
            countDisplay.textContent = charCount;
            errorDisplay.style.display = charCount > maxChars ? 'block' : 'none';
            if (charCount > maxChars) input.value = input.value.substring(0, maxChars);
        });
    }
    setupCharCount('courseTitle', 'charCount', 'T-error', 30);
    setupCharCount('description', 'DecharCount', 'D-error', 100);

    document.getElementById("video").addEventListener("change", function(event) {
        const file = event.target.files[0];
        const videoPreview = document.getElementById("videoPreview");
        videoPreview.style.display = file ? "block" : "none";
        if (file) videoPreview.src = URL.createObjectURL(file);
    });

    document.getElementById("uploadForm").addEventListener("submit", (event) => {
        let isValid = true;

        function validateInput(inputId, errorId) {
            const input = document.getElementById(inputId);
            const errorMessage = document.getElementById(errorId);
            errorMessage.style.display = input.value.trim() ? 'none' : 'block';
            if (!input.value.trim()) isValid = false;
        }
    
        validateInput("courseTitle", "courseTitle-error");
        validateInput("description", "description-error");
        validateInput("price", "price-error");
    
        const videoInput = document.getElementById("video");
        if (!videoInput.files.length) {
            if (isValid) {
                alert('Error: Please upload a video!');
            }
            isValid = false;
        }
    
        if (!isValid) event.preventDefault();
    });

});
</script>
</body>
</html>
