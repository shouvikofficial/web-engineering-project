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

        <?php
        include 'backend/connection.php';

        // get all classes from database
        $sql = "SELECT * FROM gym_classes";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                
                $class_name = $row['class_name'];
                $schedule_day = $row['schedule_day'];
                $start_time = $row['start_time'];
                $end_time = $row['end_time'];
                ?>

                <div class="card">
                    <div class="card-image"></div>
                    <div class="card-content">
                        <h3><?php echo $class_name; ?></h3>
                        <p>Schedule: <?php echo $schedule_day; ?> | <?php echo $start_time; ?> - <?php echo $end_time; ?></p>
                        <a href="#contact" class="card-link">Book Now</a>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "<p>No classes available.</p>";
        }
        ?>

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

        <?php
        include 'backend/connection.php';

        // get trainers from database
        $sql = "SELECT * FROM trainers";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                
                // get trainer from our database
                $name = $row['name'];
                $specialty = $row['specialty'];
                $img = $row['image_url'];

                // for use defalt photo
                if ($img == "") {
                    $img = "default_trainer.png";
                }
                ?>

                <div class="card trainer-card">
                    <div class="trainer-img-wrapper">
                        <img src="<?php echo $img; ?>" style="width:100%; height:250px; object-fit:cover; border-radius:10px;">
                    </div>

                    <div class="card-content text-center">
                        <h3><?php echo $name; ?></h3>
                        <span class="trainer-role"><?php echo $specialty; ?></span>
                        <p>Professional fitness trainer</p>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "No trainers found";
        }
        ?>

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

        <?php
        include 'backend/connection.php';

        //get all pricing 
        $sql = "SELECT * FROM pricing_plans ORDER BY price ASC";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['plan_name'];
            $price = $row['price'];
            $features_list = $row['features'];

            $features = explode(",", $features_list);
            ?>

            <div class="card pricing-card">

                <div class="pricing-header">
                    <h3><?php echo $name; ?></h3>
                    <div class="price">৳<?php echo number_format($price); ?><span>/mo</span></div>
                </div>

                <ul class="pricing-features">
                    <?php
                    // show all features
                    for ($i = 0; $i < count($features); $i++) {
                        $feature = trim($features[$i]);

                        // check if disabled
                        if (strpos($feature, ":no") == true) {
                            $feature = str_replace(":no", "", $feature);
                            echo "<li class='disabled'>❌ $feature</li>";
                        } else {
                            echo "<li>✅ $feature</li>";
                        }
                    }
                    ?>
                </ul>

                <?php
                // button style
                if ($name == "Plus") {
                    $button = "btn-primary";
                } else {
                    $button = "btn-outline-dark";
                }
                ?>

                <a href="start.php?plan=<?php echo $id; ?>" class="btn <?php echo $button; ?> full-width">Get Started</a>

            </div>

            <?php
        }
        ?>

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