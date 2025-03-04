const dateTimeElement = document.querySelector("#timeDate");

function updateDateTime() {
  const now = new Date();
  const options = { month: 'short', day: 'numeric', year: 'numeric', weekday: 'long' };
  const formattedDate = now.toLocaleString('en-US', options);
  const formattedTime = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
  dateTimeElement.textContent = `${formattedDate} ${formattedTime}`;
}

updateDateTime();
setInterval(updateDateTime, 1000);

// function scrollLeft() {
//   const scrollTime = document.getElementById("time");
//   let position = window.innerWidth; 

//   function animate() {
//     if (position < -scrollTime.offsetWidth) {
//       position = window.innerWidth; 
//     }
//     position -= 1;
//     scrollTime.style.left = position + "px";
//     requestAnimationFrame(animate); // Smooth animation
//   }

//   animate();
// }
// scrollLeft();
