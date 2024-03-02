const str = "01010010 01101001 01100011 01101011";
const text = document.getElementById("text");
window.onload = () => {
  for (let i = 0; i < str.length; i++) {
    let span = document.createElement("span");
    span.innerHTML = str[i];
    text.appendChild(span);
    span.style.transform = `rotate(${9.9 * i}deg)`;
  }
};


function updateClock() {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();
  if (hours < 10) hours = "0" + hours;
  if (minutes < 10) minutes = "0" + minutes;
  if (seconds < 10) seconds = "0" + seconds;
  document.getElementById('clock').textContent = hours + ":" + minutes + ":" + seconds;
}

setInterval(updateClock, 1000);
updateClock();