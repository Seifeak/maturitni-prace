const slider = document.querySelector('.slider');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

let currentPosition = 0;

function slide(direction) {
  const bookCard = document.querySelector('.book-card');
  const gap = parseInt(window.getComputedStyle(bookCard).getPropertyValue('margin-right'));
  const bookWidth = bookCard.offsetWidth + gap;
  const visibleBooks = slider.offsetWidth / bookWidth;
  const totalBooks = Math.floor(slider.children.length);

  if (direction === 'next') {
    if (currentPosition > -(bookWidth * (totalBooks - visibleBooks))) {
      currentPosition -= bookWidth;
    }
  } else if (direction === 'prev') {
    if (currentPosition < 0) {
      currentPosition += bookWidth;
    }
  }

  slider.style.transform = `translateX(${currentPosition}px)`;
}

prevButton.addEventListener('click', () => slide('prev'));
nextButton.addEventListener('click', () => slide('next'));