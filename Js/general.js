
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

// hamburger menu

const hamburger = document.querySelector(".res-menu");
let menuOpen = false;
hamburger.addEventListener("click", () => {
  const content = document.querySelector('.dropdown-content .content');
  if (!menuOpen) {
    hamburger.classList.add("open");
    menuOpen = true;
    content.style.display = 'block';
    setTimeout(() => {
      content.style.visibility = 'visible';
      content.style.opacity = '1';
    }, 0);
  } else {
    hamburger.classList.remove("open");
    menuOpen = false;
    content.style.opacity = '0';
    setTimeout(() => {
      content.style.visibility = 'hidden';
      content.style.display = 'none';
    }, 500);
  }
});
