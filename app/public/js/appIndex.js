document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.carousel-track');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    const slides = document.querySelectorAll('.carousel-track img');
    const totalSlides = slides.length;
    let currentIndex = 0;

    function updateCarousel() {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
}

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
});

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateCarousel();
});

    // Auto-slide every 5 seconds
    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
}, 5000);

    // Swipe support for mobile
    let startX = 0;
    let isSwiping = false;

    track.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isSwiping = true;
});

    track.addEventListener('touchmove', (e) => {
        if (!isSwiping) return;
        const deltaX = e.touches[0].clientX - startX;
        if (Math.abs(deltaX)> 50) {
            if (deltaX> 0) {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
} else {
                currentIndex = (currentIndex + 1) % totalSlides;
}
            updateCarousel();
            isSwiping = false;
}
});

    track.addEventListener('touchend', () => {
        isSwiping = false;
});
});