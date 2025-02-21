const dateTimeElement = document.querySelector("#timeDate");
const greetingElement = document.querySelector("#greeting");

function updateDateTime() {
  const now = new Date();
  const options = { month: 'short', day: 'numeric', year: 'numeric', weekday: 'long'};
  const formattedDate = now.toLocaleString('en-US', options);
  const formattedTime = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
  dateTimeElement.textContent = `${formattedDate} ${formattedTime}`;
}

updateDateTime();
setInterval(updateDateTime, 1000);

function scrollleft() {
  const scrollTime = document.getElementById("time");
  scrollTime.style.left = '100%';
    setTimeout(scrollleft, 25);
}
 scrollleft();

 document.addEventListener("DOMContentLoaded", () => {
  const dynamicContent = document.getElementById("dynamic-content");
  const baseURL = window.location.origin + "/server/Code/zProject/Course%20Seller/Admin/";

  document.querySelectorAll(".sidebar a").forEach(link => {
      link.addEventListener("click", function (e) {
          e.preventDefault();
          const pageUrl = new URL(this.dataset.url, baseURL).href;

          fetch(pageUrl)
              .then(res => res.text())
              .then(data => {
                  dynamicContent.innerHTML = data;
                  history.pushState({ page: pageUrl }, "", pageUrl);
              })
              .catch(err => console.error("Error:", err));
      });
  });

  window.addEventListener("popstate", (e) => {
      if (e.state?.page) {
          fetch(e.state.page)
              .then(res => res.text())
              .then(data => dynamicContent.innerHTML = data);
      }
  });
});
