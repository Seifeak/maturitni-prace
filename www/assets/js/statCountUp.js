document.addEventListener("DOMContentLoaded", function() {
    function animateNumber(element, end, duration, suffix) {
        let current = 0;
        let stepTime = duration / end;

        const interval = setInterval(function() {
            current++;
            element.textContent = current + suffix + "+";
            if (current === end) {
                clearInterval(interval);
            }
        }, stepTime);
    }

    animateNumber(document.querySelector('.stat1'), 40, 2000, "M");
    animateNumber(document.querySelector('.stat2'), 10, 1000, "M");
    animateNumber(document.querySelector('.stat3'), 100, 4000, "");
    animateNumber(document.querySelector('.stat4'), 50, 3000, "");
});