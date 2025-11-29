<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | DiuGym Center</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="form-container">
    <h2>Create a New Account</h2>
    <form action="backend/register_user.php" method="POST" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter full name" required>
        <span id="nameError" style="font-size: 0.85rem; color: #dc2626;"></span>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" placeholder="Enter phone number" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
        <div id="passReqs" style="font-size: 0.85rem; margin-top: 8px;">
          <span id="cap"></span>
          <span id="low"></span>
          <span id="num"></span>
          <span id="spec"></span>
        </div>
      </div>
      <div class="form-group">
        <label for="confirm">Confirm Password</label>
        <input type="password" id="confirm" name="confirm" placeholder="Confirm password" required>
        <span id="matchError" style="font-size: 0.85rem;"></span>
      </div>
      <button type="submit" name="register" class="btn btn-primary full-width">Register</button>
      <div id="error" style="color: red; margin-top: 10px; font-weight: 600; text-align:center;">
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'email_exists') {
          echo "Email already exists!";
        }
        ?>
      </div>
      <p class="extra">Already have an account? <a href="login.php">Login here</a></p>
    </form>
  </div>

  <script>
    function validateForm() {
      let valid = true;
      const name = document.getElementById("fullname").value;
      const pass = document.getElementById("password").value;
      const conf = document.getElementById("confirm").value;

      // Check name
      for (let i = 0; i < name.length; i++) {
        const ch = name[i];
        if (!((ch >= 'A' && ch <= 'Z') || (ch >= 'a' && ch <= 'z') || ch == ' ')) {
          document.getElementById("nameError").innerHTML = "Name can only contain letters and spaces";
          valid = false;
          break;
        }
      }

      // Check password requirements
      let hasUpper = false, hasLower = false, hasDigit = false, hasSpecial = false;
      for (let i = 0; i < pass.length; i++) {
        const ch = pass[i];
        if (ch >= 'A' && ch <= 'Z') hasUpper = true;
        else if (ch >= 'a' && ch <= 'z') hasLower = true;
        else if (ch >= '0' && ch <= '9') hasDigit = true;
        else if (ch != ' ') hasSpecial = true;
      }

      if (!hasUpper || !hasLower || !hasDigit || !hasSpecial) {
        alert("Password must contain uppercase, lowercase, digit, and special character");
        valid = false;
      }

      // Check match
      if (pass !== conf) {
        document.getElementById("matchError").innerHTML = "Passwords do not match";
        document.getElementById("matchError").style.color = "#dc2626";
        valid = false;
      }

      return valid;
    }

    // Name validation
    document.getElementById("fullname").addEventListener("input", function () {
      const val = this.value;
      let err = "";
      for (let i = 0; i < val.length; i++) {
        const ch = val[i];
        if (!((ch >= 'A' && ch <= 'Z') || (ch >= 'a' && ch <= 'z') || ch == ' ')) {
          err = "<br>Cannot use special characters or numbers";
          break;
        }
      }
      document.getElementById("nameError").innerHTML = err;
    });

    // Password validation
    document.getElementById("password").addEventListener("input", function () {
      const val = this.value;
      let hasUpper = false, hasLower = false, hasDigit = false, hasSpecial = false;

      for (let i = 0; i < val.length; i++) {
        const ch = val[i];
        if (ch >= 'A' && ch <= 'Z') hasUpper = true;
        else if (ch >= 'a' && ch <= 'z') hasLower = true;
        else if (ch >= '0' && ch <= '9') hasDigit = true;
        else if (ch != ' ') hasSpecial = true;
      }

      const ok = "#10b981", err = "#dc2626";
      document.getElementById("cap").innerHTML = hasUpper ? "<br>✅ Capital letter" : "<br>❌ One capital letter";
      document.getElementById("cap").style.color = hasUpper ? ok : err;

      document.getElementById("low").innerHTML = hasLower ? "<br>✅ Lowercase" : "<br>❌ One lowercase";
      document.getElementById("low").style.color = hasLower ? ok : err;

      document.getElementById("num").innerHTML = hasDigit ? "<br>✅ Digit" : "<br>❌ One digit";
      document.getElementById("num").style.color = hasDigit ? ok : err;

      document.getElementById("spec").innerHTML = hasSpecial ? "<br>✅ Special char" : "<br>❌ One special char";
      document.getElementById("spec").style.color = hasSpecial ? ok : err;
    });

    // Confirm password validation
    document.getElementById("confirm").addEventListener("input", function () {
      const pass = document.getElementById("password").value;
      const conf = this.value;
      const match = pass === conf;

      document.getElementById("matchError").innerHTML = match ? "<br>✅ Passwords match" : "<br>❌ Passwords do not match";
      document.getElementById("matchError").style.color = match ? "#10b981" : "#dc2626";
    });
  </script>
</body>

</html>