    const animatedText = document.getElementById("greet");
    const dateTimeElement = document.getElementById("dateTime");
    const greetingElement = document.getElementById("greeting");
    const colors = ["#3498db", "#2ecc71", "#f39c12", "#e74c3c"];
    let currentColorIndex = 0;

    function putColorOnGreet() {
      animatedText.style.color = colors[currentColorIndex];
      currentColorIndex = (currentColorIndex + 1) % colors.length;
      setTimeout(putColorOnGreet, 5000);
    }

    function updateDateTime() {
      const now = new Date();
      const options = { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' };
      const formattedDateTime = now.toLocaleString('en-US', options) + " " + now.toLocaleTimeString();
      dateTimeElement.textContent = formattedDateTime;
    }

    function greeting() {
      const now = new Date();
      if (now.getHours() < 12) {
        greetingElement.textContent = "Good Morning, It's";
        greetingElement.style.color = "#2ecc71";
      } else if (now.getHours() >= 12 && now.getHours() <= 18) {
        greetingElement.textContent = "Good Afternoon, It's";
        greetingElement.style.color = "#0701B8";
      } else {
        greetingElement.textContent = "Good Evening, It's";
        greetingElement.style.color = "#EA8E02";
      }
    }

    putColorOnGreet();
    greeting();
    updateDateTime();
    setInterval(updateDateTime, 1000);




