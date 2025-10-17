// Mobile menu functionality
const menuBtn = document.getElementById('menuBtn');
const nav = document.getElementById('nav');

menuBtn.addEventListener('click', function() {
  nav.classList.toggle('active');
});

const navLinks = nav.querySelectorAll('a');
navLinks.forEach(function(link) {
  link.addEventListener('click', function() {
    nav.classList.remove('active');
  });
});

// Make buttons work
function setupButtons() {
  var buttons = document.querySelectorAll('.hero-buttons a');
  
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].onclick = function(e) {
      var link = this.getAttribute('href');
      if (link.startsWith('#')) {
        e.preventDefault();
        var section = document.querySelector(link);
        if (section) {
          section.scrollIntoView({ behavior: 'smooth' });
        }
      }
    };
  }
}

// Start everything when page loads
window.onload = function() {
  setupButtons();
};