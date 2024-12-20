document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("container2");
  const img = document.getElementById("original-image");
  const cols = 60; // Nombre de colonnes
  const rows = 40; // Nombre de lignes
  const squareWidth = img.naturalWidth / cols;
  const squareHeight = img.naturalHeight / rows;

  for (let y = 0; y < rows; y++) {
    for (let x = 0; x < cols; x++) {
      const square = document.createElement("div");
      square.classList.add("square");
      square.style.width = `${squareWidth}px`;
      square.style.height = `${squareHeight}px`;
      square.style.top = `${y * squareHeight}px`;
      square.style.left = `${x * squareWidth}px`;
      square.style.backgroundImage = `url(${img.src})`;
      square.style.backgroundPosition = `-${x * squareWidth}px -${
        y * squareHeight
      }px`;
      square.style.opacity = 1;
      container.appendChild(square);

      // Ajouter un délai aléatoire pour l'animation de décomposition
      setTimeout(() => {
        const angle = Math.random() * 2 * Math.PI;
        const distance = Math.random() * 400; // Distance aléatoire pour l'éclat
        const translateX = Math.cos(angle) * distance;
        const translateY = Math.sin(angle) * distance;

        square.style.transform = `translate(${translateX}px, ${translateY}px) rotate(${
          Math.random() * 720 - 360
        }deg)`;
        square.style.opacity = 0;
      }, Math.random() * 1000 + 500);
    }
  }

  // Réinitialiser l'image après un certain temps
  setTimeout(() => {
    const squares = document.querySelectorAll(".square");
    squares.forEach((square) => {
      square.style.transitionDuration = "1s"; // Augmentation du temps de transition pour la reconstruction
      square.style.transform = "translate(0, 0)";
      square.style.opacity = 1;
    });
  }, 4000); // Ajustement du temps avant la reconstruction
});





