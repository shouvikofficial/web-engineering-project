// Header scroll effect
const header = document.getElementById('header');
if (header) {
  window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
}

// Mobile menu
const menuBtn = document.getElementById('menuToggle');
const nav = document.getElementById('nav');

if (menuBtn && nav) {
  menuBtn.addEventListener('click', function() {
    const isOpen = nav.classList.toggle('active');
    menuBtn.classList.toggle('active');
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });

  // Close menu on link click
  const links = nav.querySelectorAll('.nav-link');
  links.forEach(link => {
    link.addEventListener('click', function() {
      nav.classList.remove('active');
      menuBtn.classList.remove('active');
      document.body.style.overflow = '';
    });
  });

  // Close on escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && nav.classList.contains('active')) {
      nav.classList.remove('active');
      menuBtn.classList.remove('active');
      document.body.style.overflow = '';
    }
  });
}

// Counter animation for stats
const counters = document.querySelectorAll('.stat-number');
let hasAnimated = false;

function animateNumbers() {
  if (hasAnimated) return;
  hasAnimated = true;
  
  counters.forEach(counter => {
    const text = counter.textContent.trim();
    if (!text.includes('+') && !text.includes('/')) return;
    
    const num = parseInt(text.replace(/\D/g, ''));
    const increment = num / 60;
    let current = 0;
    
    const timer = setInterval(() => {
      current += increment;
      if (current >= num) {
        counter.textContent = text;
        clearInterval(timer);
      } else {
        counter.textContent = Math.floor(current) + (text.includes('+') ? '+' : '');
      }
    }, 30);
  });
}

// Trigger animation when stats visible
const stats = document.querySelector('.hero-stats');
if (stats) {
  window.addEventListener('scroll', function() {
    const rect = stats.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
      animateNumbers();
    }
  });
}

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    if (href === '#') return;
    
    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      const top = target.getBoundingClientRect().top + window.pageYOffset - 80;
      window.scrollTo({ top: top, behavior: 'smooth' });
    }
  });
});

// Simple fade in animation
const cards = document.querySelectorAll('.card, .feature-card');
cards.forEach(card => {
  card.style.opacity = '0';
  card.style.transform = 'translateY(20px)';
  card.style.transition = 'opacity 0.6s, transform 0.6s';
});

window.addEventListener('scroll', function() {
  cards.forEach(card => {
    const rect = card.getBoundingClientRect();
    if (rect.top < window.innerHeight - 100) {
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }
  });
});


//drop-down menu for profile

function toggleMenu() {
    let menu = document.getElementById("profileDropdown");

    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

document.addEventListener("click", function(event) {
    let isClickInside = event.target.closest(".profile-menu");

    if (!isClickInside) {
        document.getElementById("profileDropdown").style.display = "none";
    }
});
