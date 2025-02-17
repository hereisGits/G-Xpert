
window.onload = function () {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../Admin/Manage Course/course media/fetch_course.php', true);
  
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const videoList = document.querySelector('.video-list');
            if (videoList) {
                videoList.innerHTML = xhr.responseText;
            } else {
                console.error("Error: Element '.video-list' not found!");
            }
        }
    };
  
    xhr.send();
};
