<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DiuGym Center | Fitness & Wellness</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <?php include "includes/header.php"; ?>

  <main>
    <section id="home" class="hero">
      <div class="hero-overlay"></div>
      <div class="hero-content container">
        <span class="hero-badge">Fitness Center</span>
        <h1 class="hero-title">Transform Your Body,<br>Elevate Your Mind</h1>
        <p class="hero-subtitle">Experience professional training, state-of-the-art equipment, and a supportive
          community designed to help you achieve your fitness goals.</p>
        <div class="hero-buttons">
          <a href="register.php" class="btn btn-primary btn-lg">Start Your Journey</a>
          <a href="#classes" class="btn btn-secondary btn-lg">Explore Classes</a>
        </div>
        <div class="hero-stats">
          <div class="stat-item">
            <span class="stat-number">5+</span>
            <span class="stat-label">Expert Trainers</span>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <span class="stat-number">200+</span>
            <span class="stat-label">Members</span>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <span class="stat-number">10AM - 10PM</span>
            <span class="stat-label">Access</span>
          </div>
        </div>
      </div>
    </section>

    <section id="features" class="section features">
      <div class="container">
        <div class="features-grid">
          <div class="feature-card">
            <div class="feature-icon-wrapper">🏋️</div>
            <h3>Professional Training</h3>
            <p>Certified coaches dedicated to your personal growth and safety.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon-wrapper">⚡</div>
            <h3>Modern Equipment</h3>
            <p>Top-tier machinery and free weights for every workout style.</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon-wrapper">🤝</div>
            <h3>Supportive Community</h3>
            <p>Join like-minded individuals on your fitness journey.</p>
          </div>
        </div>
      </div>
    </section>

    <section id="about" class="section about">
      <div class="container about-container">
        <div class="about-content">
          <span class="section-tag">About Us</span>
          <h2>More Than Just a Gym</h2>
          <p>We believe fitness should feel friendly and achievable. Our center combines a welcoming environment with
            professional support so you can train confidently, no matter your starting point.</p>
          <p>Whether you're a beginner or a pro athlete, DiuGym provides the space and guidance you need to reach your
            goals.</p>
          <a href="#contact" class="btn btn-text">Learn More &rarr;</a>
        </div>
        <div class="about-image">
          <div class="image-placeholder"></div>
        </div>
      </div>
    </section>

    <section id="classes" class="section bg-light">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-tag">Our Classes</span>
          <h2>Find Your Rhythm</h2>
          <p>Diverse classes designed to keep you motivated and challenged.</p>
        </div>
        <div class="cards-grid">
          <div class="card">
            <div class="card-image"></div>
            <div class="card-content">
              <h3>Strength & Conditioning</h3>
              <p>Small group sessions that focus on building strength with proper form and pacing.</p>
              <a href="#" class="card-link">View Schedule</a>
            </div>
          </div>
          <div class="card">
            <div class="card-image"></div>
            <div class="card-content">
              <h3>Functional HIIT</h3>
              <p>High-energy intervals that mix cardio and bodyweight training for all fitness levels.</p>
              <a href="#" class="card-link">View Schedule</a>
            </div>
          </div>
          <div class="card">
            <div class="card-image"></div>
            <div class="card-content">
              <h3>Mindful Mobility</h3>
              <p>Gentle stretching and core stability sessions to keep you flexible and energized.</p>
              <a href="#" class="card-link">View Schedule</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="trainers" class="section">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-tag">Expert Team</span>
          <h2>Meet the Trainers</h2>
        </div>
        <div class="cards-grid">
          <div class="card trainer-card">
            <div class="trainer-img-wrapper">
              <div class="trainer-placeholder"></div>
            </div>
            <div class="card-content text-center">
              <h3>Nehal S.</h3>
              <span class="trainer-role">Strength Coach</span>
              <p>Dedicated to building sustainable training routines that last a lifetime.</p>
            </div>
          </div>
          <div class="card trainer-card">
            <div class="trainer-img-wrapper">
              <div class="trainer-placeholder"></div>
            </div>
            <div class="card-content text-center">
              <h3>Sadia K.</h3>
              <span class="trainer-role">Nutrition Specialist</span>
              <p>Pairs smart fueling strategies with functional workouts for optimal results.</p>
            </div>
          </div>
          <div class="card trainer-card">
            <div class="trainer-img-wrapper">
              <div class="trainer-placeholder"></div>
            </div>
            <div class="card-content text-center">
              <h3>Ayan A.</h3>
              <span class="trainer-role">HIIT Instructor</span>
              <p>Known for upbeat sessions that keep members motivated and moving.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="pricing" class="section bg-dark text-white">
      <div class="container">
        <div class="section-header text-center">
          <span class="section-tag">Membership</span>
          <h2 class="text-white">Choose Your Plan</h2>
        </div>
        <div class="pricing-grid">
          <div class="card pricing-card">
            <div class="pricing-header">
              <h3>Starter</h3>
              <div class="price">৳2,500<span>/mo</span></div>
            </div>
            <ul class="pricing-features">
              <li>✅ Gym floor access</li>
              <li>✅ 2 classes per week</li>
              <li>✅ Monthly fitness check-in</li>
              <li class="disabled">❌ Personal coaching</li>
            </ul>
            <a href="register.html" class="btn btn-outline-dark full-width">Get Started</a>
          </div>
          <div class="card pricing-card">
            <div class="pricing-header">
              <h3>Plus</h3>
              <div class="price">৳4,000<span>/mo</span></div>
            </div>
            <ul class="pricing-features">
              <li>✅ Unlimited gym access</li>
              <li>✅ Unlimited group classes</li>
              <li>✅ Personalized workout plan</li>
              <li>✅ Wellness resources</li>
            </ul>
            <a href="register.html" class="btn btn-primary full-width">Get Started</a>
          </div>
          <div class="card pricing-card">
            <div class="pricing-header">
              <h3>Premium</h3>
              <div class="price">৳6,500<span>/mo</span></div>
            </div>
            <ul class="pricing-features">
              <li>✅ Everything in Plus</li>
              <li>✅ 1-on-1 coaching (2x/month)</li>
              <li>✅ Custom nutrition plan</li>
              <li>✅ Priority support 24/7</li>
            </ul>
            <a href="register.html" class="btn btn-outline-dark full-width">Get Started</a>
          </div>
        </div>
      </div>
    </section>

    <section id="contact" class="section bg-light">
      <div class="container contact-container">
        <div class="contact-info">
          <span class="section-tag">Get in Touch</span>
          <h2>We're Here to Help</h2>
          <p>Have questions? Visit us, call us, or send a message. We'd love to hear from you.</p>
          <div class="contact-details">
            <div class="contact-item">
              <span class="icon">📍</span>
              <div>
                <strong>Location</strong>
                <p>123 Fitness Blvd, Dhaka, Bangladesh</p>
              </div>
            </div>
            <div class="contact-item">
              <span class="icon">📞</span>
              <div>
                <strong>Phone</strong>
                <p><a href="tel:+880123456789">+880 1234 56789</a></p>
              </div>
            </div>
            <div class="contact-item">
              <span class="icon">✉️</span>
              <div>
                <strong>Email</strong>
                <p><a href="mailto:hello@diugym.com">hello@diugym.com</a></p>
              </div>
            </div>
            <div class="contact-item">
              <span class="icon">⏰</span>
              <div>
                <strong>Hours</strong>
                <p>Daily: 7:00 AM - 10:00 PM</p>
              </div>
            </div>
          </div>
        </div>
        <div class="contact-form-wrapper">
          <form class="contact-form">
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" type="text" placeholder="Your name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea id="message" rows="4" placeholder="How can we help?" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary full-width">Send Message</button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <?php include "includes/footer.php"; ?>

  <script src="assets/js/script.js"></script>
</body>

</html>