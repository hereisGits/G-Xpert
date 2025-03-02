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
