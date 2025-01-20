const popup = document.querySelector('#status-div p'); 
  if (popup) {
      setTimeout(() => {
          popup.style.display = 'none';
      }, 2000);
  }


  function switchTab(tabName) {
      const tabs = document.querySelectorAll('.tab');
      const sections = document.querySelectorAll('.section');

      tabs.forEach(tab => tab.classList.remove('active'));
      sections.forEach(section => section.classList.remove('active'));

      document.getElementById(tabName).classList.add('active');
      document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
  }
   
  document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab");
    const sections = document.querySelectorAll(".section");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            
            tabs.forEach(tab => tab.classList.remove("active"));
            sections.forEach(section => section.classList.remove("active"));
            tab.classList.add("active");
            sections[index].classList.add("active");
        });
    });

    const profileInput = document.getElementById("profile");
    const profilePreview = document.getElementById("profile-preview");

    profileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                profilePreview.src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    });

    const goBackButton = document.querySelector(".goback button");
    if (goBackButton) {
        goBackButton.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }
});