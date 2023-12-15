var sidebar = document.getElementById("sidebar");
var main = document.getElementById("headAndCon");
var elementStyle = window.getComputedStyle(sidebar);
var width = parseFloat(elementStyle.getPropertyValue("width"));
var screenWidth =
  window.innerWidth ||
  document.documentElement.clientWidth ||
  document.body.clientWidth;

function toggleSidebar() {
  var elementStyle = window.getComputedStyle(sidebar);
  var width = parseFloat(elementStyle.getPropertyValue("width"));
  var screenWidth =
    window.innerWidth ||
    document.documentElement.clientWidth ||
    document.body.clientWidth;

  if (screenWidth <= 768) {
    if (width == 0) {
      sidebar.style.width = "100%";
      main.style.width = "0%";
    } else {
      sidebar.style.width = "0%";
      main.style.width = "100%";
    }
  } else if (width > 0) {
    sidebar.style.width = "0%";
    main.style.width = "100%";
  } else {
    sidebar.style.width = "20%";
    main.style.width = "80%";
  }
}

function handleResize() {
  var screenWidth =
    window.innerWidth ||
    document.documentElement.clientWidth ||
    document.body.clientWidth;

  if (screenWidth <= 768) {
    sidebar.style.width = "0%";
    main.style.width = "100%";
  } else {
    sidebar.style.width = "20%";
    main.style.width = "80%";
  }
}

// Add event listener for the resize event
window.addEventListener("resize", handleResize);

// Initial call to set up initial screen size
handleResize();

function loadMenu() {
  document.getElementById("sidebar").style.display = "flex";
}

document.addEventListener("DOMContentLoaded", loadMenu);
