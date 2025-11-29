<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | DiuGym Center</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="form-container">
		<h2>Sign in to Your Account</h2>
		<form action="backend/login_user.php" method="POST">
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" id="email" name="email" placeholder="you@example.com" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" placeholder="Enter your password" required>
			</div>
			<div class="form-meta">
				<label class="remember-me">
					<input type="checkbox" id="remember" name="remember">
					<span>Remember me</span>
				</label>
				<a href="#" class="forgot-link">Forgot password?</a>
			</div>
			<button type="submit" name="login" class="btn btn-primary full-width">Login</button>
			<?php
			if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
				?>
				<p style="color: red; margin-top: 10px; text-align:center;">Invalid email or password!</p>
				<?php
			}
			?>
		</form>
		<p class="extra">Don't have an account? <a href="register.php">Register</a></p>
	</div>
</body>

</html>