const mainImage = document.getElementById('mainImage');
const thumbnails = document.querySelectorAll('.thumb');
const guidepopup = document.querySelector('.size-guide');
const popup = document.querySelector('.guide-popup');
const closePopup = document.querySelector('#close-button');
thumbnails.forEach(thumb => {
    thumb.addEventListener('click', () => {
        const tempSrc = mainImage.src;
        mainImage.src = thumb.src;
        thumb.src = tempSrc;
    });
});


const sizebuttons = document.querySelectorAll('.size-button');
sizebuttons.forEach(button => {
    button.addEventListener('click', () => {
        sizebuttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    });
});

document.querySelectorAll('.like-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const icon = btn.querySelector('i');
    icon.classList.add('bounce');
    setTimeout(() => icon.classList.remove('bounce'), 300);
    icon.classList.toggle('bx-heart');
    icon.classList.toggle('bxs-heart');
    btn.classList.toggle('liked');
  });
});

guidepopup.addEventListener('click', () => {
  popup.classList.toggle('active');
}
);

closePopup.addEventListener('click', () => {
  popup.classList.remove('active');
});
window.addEventListener("pageshow", (event) => {
  if (event.persisted) {
      location.reload(); // forces a full reload when returning
  }
});
window.addEventListener("DOMContentLoaded", () => {
  setupCarousel(); // or any other setup logic
});
