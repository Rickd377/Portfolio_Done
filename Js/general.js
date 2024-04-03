
// rotating text
const str = "01110010 01101001 01100011 01101011";
const text = document.getElementById("text");
window.onload = () => {
  for (let i = 0; i < str.length; i++) {
    let span = document.createElement("span");
    span.innerHTML = str[i];
    text.appendChild(span);
    span.style.transform = `rotate(${10 * i}deg)`;
    span.className = "rotatingSpan"; // Assign a class to the span
  }
};

