const circle = document.querySelector('.circle');
const images = circle.querySelectorAll('img');
const total = images.length;

let angle = 0;

// Расположение по кругу
images.forEach((img, i) => {
  const rotation = (360 / total) * i;
  img.style.transform = `rotateY(${rotation}deg) translateZ(150px)`;
});

function rotateLeft() {
  angle -= 72;
  circle.style.transform = `rotateY(${angle}deg)`;
}

function rotateRight() {
  angle += 72;
  circle.style.transform = `rotateY(${angle}deg)`;
}
