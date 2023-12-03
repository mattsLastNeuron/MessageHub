//code to get the menu open and close button.
const menuToggle = document.getElementById('menu-toggle');
const menuClose = document.getElementById('menu-close');

//Event listeners used to open and close the menu on click.
menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
});

menuClose.addEventListener('click', () => {
    menuToggle.classList.remove('active');
});

function updateDivVisibility() {
    if (window.innerWidth > 768) { 
        document.querySelector('.menu').style.display = "none";
    } else {
        document.querySelector('.menu').style.display = "flex";
    }
}

// Initial check on page load
document.addEventListener('DOMContentLoaded', updateDivVisibility);

// Listen for window resize events
window.addEventListener('resize', updateDivVisibility);


