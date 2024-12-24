
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


  // for manage user

// function redirectToManageUser(){
//   window.location.href = "Manage users/manage_user.php";
// }

// function loadContent(url, targetElementId) {
//   let xhttps = new XMLHttpRequest();

//   xhttps.onreadystatechange = () => {
//       if (xhttps.readyState == 4 && xhttps.status == 200) {
//           document.getElementById(targetElementId).innerHTML = xhttps.responseText;
//       }
//   };

//   xhttps.open('POST', url, true);
//   xhttps.send();
// }


// document.getElementById('manageUser').addEventListener('click', () => {
//   loadContent('Manage users/manage_user.php', 'content');
// });
