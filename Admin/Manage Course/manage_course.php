<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Management System</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-color: #007bff;
        --secondary-color: #00c6ff;
        --background-color: #ffffff;
        --text-color: #000000;
        --border-color: #ddd;
        --box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        --border-radius: 5px;
        --padding: 20px;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    
    .main-container {                
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
        margin-top: 20px;
        padding: 20px 40px;
    }
    .title h1 {
        text-align: center;
        font-size: 24px;
        color: var(--primary-color);
        margin: 0;
    }
    .title p {
        text-align: center;
        font-size: 14px;
        color: #7f8c8d;
    }
    .card {
        background: var(--white-color);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: var(--padding);
        margin: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    input, textarea, button{
        width: 100%;
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        outline: none;
        transition: box-shadow 0.4s ease;
    }
    input:hover, input:focus,
    textarea:hover, textarea:focus{
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .upload-label {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .upload-label:hover {
        background-color: #0056b3;
    }


    input[type="file"] {
        display: none;
    }


    label[for="thumbnail"] {
        font-size: 16px;
        color: white;
        margin-bottom: 5px;
    }


    #thumbnailPreview {
        display: none;
        max-width: 200px;
        margin-top: 10px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }


    .upload-label i {
        margin-left: 8px;
        font-size: 18px;
    }


    input[type="file"]:focus {
        outline: none;
        box-shadow: 0 0 3px #007BFF;
    }
    .char-count{
        font-size: smaller;
        margin: 3px 0 15px 5px;
        color: #7f8c8d;
        display: flex;
    }
    .char-count .error{
        margin-left: 5px;
        display: none;
        color: red;
    }
    textarea{
        width: 100%; 
        height: 150px; 
        resize: none; 
        overflow-y: auto; 
        padding: 10px; 
    }
    button {
        background: var(--primary-color);
        color: var(--white-color);
        border: none;
        cursor: pointer;
        transition: background 0.3s;
    }
    button:hover {
        background: #0056b3;
    }
    .progress-bar {
        height: 20px;
        background: var(--border-color);
        border-radius: var(--border-radius);
        overflow: hidden;
        margin-bottom: 20px;
    }
    .progress-bar div {
        height: 100%;
        background: var(--primary-color);
        width: 0;
        transition: width 0.4s ease;
    }
    .course-list ul {
        list-style: none;
        padding: 0;
    }
    .course-list li {
        background: #f9f9f9;
        margin: 10px 0;
        padding: 15px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
</head>
<body>
    <div class="main-container">
        <div class="title">
            <h1>Upload Courses</h1>
            <p>Add and manage course details efficiently!</p>
        </div>
        <div  class="card">
            <section id="form">
                <form id="uploadForm">

                    <label for="video" class="upload-label">Upload Video <i class="fa-solid fa-video"></i></label>
                    <input type="file" name="video" id="video" accept="video/*" required>


                    <label for="thumbnail" class="upload-label">Thumbnail <i class="fa-solid fa-image"></i></label>
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required>
                    <img id="thumbnailPreview" style="display: none; max-width: 200px; margin-top: 10px;">

                    <label for="courseTitle">Course Title:</label>
                    <input type="text" id="courseTitle" name="courseTitle" required placeholder="Enter course title">
                    <div class="char-count">
                        Characters: <span id="charCount">0</span> / 20
                        <p id="T-error" class="error"> (Character limit exceeded!)</p>
                    </div>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required placeholder="Enter course description"></textarea>
                    <div class="char-count">
                        Characters: <span id="DecharCount">0</span> / 100
                        <p id="D-error" class="error"> (Character limit exceeded!)</p>
                    </div>

                    <label for="schedule">Schedule:</label>
                    <input type="datetime-local" id="schedule" name="schedule">

                    <div class="progress-bar">
                        <div></div>
                    </div>

                    <button type="submit">Upload</button>
                </form>
            </section>
            <section id="video">
            </section>

        </div>

        <section class="card course-list">
            <h2>Available Courses</h2>
            <ul id="courseList"></ul>
        </section>
    </div>

    <script>
        const titleInput = document.getElementById('courseTitle');
        const descripInput = document.getElementById('description');

        const titleCount = document.getElementById('charCount');
        const descripCount = document.getElementById('DecharCount');

        const titleErrorDisplay = document.getElementById('T-error');
        const descErrorDisplay = document.getElementById('D-error');

        titleInput.addEventListener('input', (e) => {
            const charCount = e.target.value.length;

            if (charCount <= 20) {
                titleCount.textContent = charCount; 
            } else {
                e.target.value = e.target.value.substring(0, 20); 
                titleErrorDisplay.style.display='block'
            }
        });
        
        
        descripInput.addEventListener('input', (e) => {
            const charCount = e.target.value.length;
            if (charCount <= 100) {
                descripCount.textContent = charCount; 
            } else {
                e.target.value = e.target.value.substring(0, 100); 
                descErrorDisplay.style.display='block'
            }
        });

        const uploadForm = document.getElementById('uploadForm');
        const thumbnailInput = document.getElementById('thumbnail');
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        const courseList = document.getElementById('courseList');

        uploadForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const title = document.getElementById('courseTitle').value;
            const description = document.getElementById('description').value;
            const schedule = document.getElementById('schedule').value;
            const thumbnail = thumbnailInput.files[0];

            if (!title || !description || !schedule || !thumbnail) {
                alert('All fields are required!');
                return;
            }

            const reader = new FileReader();
            reader.onload = () => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <div>
                        <img src="${reader.result}" alt="Thumbnail" style="width: 50px; height: 50px; border-radius: var(--border-radius);">
                        <div>
                            <strong>${title}</strong>
                            <p>${description}</p>
                            <small>Schedule: ${schedule}</small>
                        </div>
                    </div>
                    <button onclick="this.closest('li').remove()">Delete</button>
                `;
                courseList.appendChild(li);
            };
            reader.readAsDataURL(thumbnail);

            uploadForm.reset();
        });

        thumbnailInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    thumbnailPreview.src = reader.result;
                    thumbnailPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
