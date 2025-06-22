let productList = document.getElementById('productList');
let scrollAmount = 0;

function scrollLeft() {
    scrollAmount -= 220;
    if (scrollAmount < 0) {
        scrollAmount = 0;
    }
    productList.style.transform = 'translateX(-' + scrollAmount + 'px)';
}

function scrollRight() {
    let maxScroll = productList.scrollWidth - productList.clientWidth;
    scrollAmount += 220;
    if (scrollAmount > maxScroll) {
    scrollAmount = maxScroll;
    }
    productList.style.transform = 'translateX(-' + scrollAmount + 'px)';
}
document.addEventListener("DOMContentLoaded", function () {
  const wishlistIcons = document.querySelectorAll(".wishlist i");

  wishlistIcons.forEach(function (icon) {
    icon.addEventListener("click", function () {
      icon.classList.toggle("fa-regular"); 
      icon.classList.toggle("fa-solid");  
      icon.parentElement.classList.toggle("active"); 
    });
  });
});
