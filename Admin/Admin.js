
 const dateTimeElement = document.getElementById("dateTime");
 const animatedText = document.getElementById("greet");

  colors = [ "#3498db", "#2ecc71",  "#f39c12", "#e74c3c",]; 
  let currentColorIndex = 0;

  function putcolorOnGreet(){
    animatedText.style.color = colors[currentColorIndex]; 
    currentColorIndex = (currentColorIndex + 1) % colors.length; 

    setTimeout(putcolorOnGreet, 5000);
  }


  function updateDateTime() {
    const now = new Date();
    const options = { weekday: 'long', month: 'short', year: 'numeric' };
    const formattedDateTime = now.toLocaleString('en-us', options) + " " + now.toLocaleTimeString();
    dateTimeElement.textContent = formattedDateTime;
  }

  function greeting(){
    const now = new Date();
      if(now.getHours() < 12){
        document.getElementById('greeting').textContent = "Good Morning," + " " + "It's";
        document.getElementById('greeting').style.color = "#2ecc71";
      }else if(now.getHours() >= 12 && now.getHours() <= 18){
        document.getElementById('greeting').textContent = "Good Afternoon, " + " " + "It's"; 
        document.getElementById('greeting').style.color = "#0701B8";
      }else{
          document.getElementById('greeting').textContent = "Good Evening, " + " " + "It's";
          document.getElementById('greeting').style.color = "#EA8E02";
      }
  }

  putcolorOnGreet();
  greeting();
  updateDateTime();
  setInterval(updateDateTime, 1000);



  document.addEventListener('DOMContentLoaded', () => {
    const listItems = document.querySelectorAll('.sidebar li'); 
    const content = document.getElementById('dynamic-content'); 

    listItems.forEach(li => {
        li.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default behavior

            const link = li.querySelector('a'); 
            const page = link.getAttribute('data-page'); 

            if (page) {
                fetch(page)
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to load content');
                        return response.text();
                    })
                    .then(data => {
                        content.innerHTML = data; // Update dynamic content
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        content.innerHTML = '<p style="text-align:center; margin-top:20px; font-weight:550; color:#555;">Could not load content.</p>';
                    });
            }
        });
    });
});


              
              
              
