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


 $(document).ready(function () {
  var lastUrl = localStorage.getItem("lastPage");
  var isFirstVisit = sessionStorage.getItem("firstVisit") === null;

  if (isFirstVisit || !lastUrl) {
      lastUrl = $('#dashboard').data('url'); // Set dashboard as default
      sessionStorage.setItem("firstVisit", "no"); // Mark visit
  }

  $('#dynamic-content').load(lastUrl);

  $('ul li a').click(function (e) {
      e.preventDefault();
      var url = $(this).attr('data-url');

      if (url) {
          localStorage.setItem("lastPage", url); // Store last visited page
          $(".loader").show();
          $("#dynamic-content").html("");
          $.get(url, function (data) {
              $(".loader").hide();
              $("#dynamic-content").html(data);
          }).fail(function () {
              $(".loader").hide();
              $("#dynamic-content").html("<p>Error loading content!</p>");
          });
      } else {
          $("#dynamic-content").html("<p>Content is not added yet!</p>");
      }
  });
});










