function initCarousel(carouselContainer, visibleCount = 3) {
    const carousel = carouselContainer.querySelector('.carousel');
    const items = carousel.querySelectorAll('.carousel-item');
    const totalItems = items.length;

    let index = 0;

    const dotsContainer = carouselContainer.querySelector('.dots-container');
    dotsContainer.innerHTML = ''; // Clear existing dots

    // Create dots
    for (let i = 0; i <= totalItems - visibleCount; i++) {
        const dot = document.createElement("div");
        dot.classList.add("dot");
        dot.setAttribute("data-index", i);
        dot.addEventListener("click", () => goToSlide(i));
        dotsContainer.appendChild(dot);
    }

    const dots = dotsContainer.querySelectorAll(".dot");

    function updateDots() {
        dots.forEach(dot => dot.classList.remove("active"));
        if (dots[index]) dots[index].classList.add("active");
    }

    function getItemWidth() {
        const style = getComputedStyle(items[0]);
        const gap = parseInt(style.marginRight || '20');
        return items[0].offsetWidth + gap;
    }

    function scrollToIndex(i) {
        const itemWidth = getItemWidth();
        carousel.scrollTo({
            left: i * itemWidth,
            behavior: 'smooth',
        });
        index = i;
        updateDots();
    }

    function goToSlide(i) {
        scrollToIndex(i);
    }

    // Auto loop
    setInterval(() => {
        index = (index + 1) % (totalItems - visibleCount + 1);
        scrollToIndex(index);
    }, 3000);

    updateDots();
}

const getVisibleCount = () => window.innerWidth < 600 ? 1 : 3;

document.querySelectorAll('.carousel-container').forEach(container => {
    initCarousel(container, getVisibleCount());
});