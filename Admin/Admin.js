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
        lastUrl = $('#dashboard').data('url'); // Default to dashboard
        sessionStorage.setItem("firstVisit", "no");
    }

    $('#dynamic-content').load(lastUrl, function () {
        rebindEvents(); // Ensure events are bound
    });

    $('ul li a').click(function (e) {
        e.preventDefault();
        var url = $(this).attr('data-url');

        if (url) {
            localStorage.setItem("lastPage", url);
            $(".loader").show();
            $("#dynamic-content").html("");

            $.get(url, function (data) {
                $(".loader").hide();
                $("#dynamic-content").html(data);
                rebindEvents(); // Rebind events after loading content
            }).fail(function () {
                $(".loader").hide();
                $("#dynamic-content").html("<p>Error loading content!</p>");
            });
        } else {
            $("#dynamic-content").html("<p>Content is not added yet!</p>");
        }
    });
});

// Function to bind event handlers to dynamically loaded content
function rebindEvents() {
    $(document).on("submit", "#uploadCourseForm", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $(".loader").show();

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $(".loader").hide();
                $("#responseMessage").html(response);
            },
            error: function () {
                $(".loader").hide();
                $("#responseMessage").html("<p>Error uploading course!</p>");
            }
        });
    });
}











