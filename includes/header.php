<header class="header" id="header">
    <div class="container">
        <div class="header-wrapper">
            <a href="#home" class="logo">
                <span class="logo-icon">⚡</span>
                <span class="logo-text">DiuGym</span>
            </a>
            <nav class="nav" id="nav">
                <ul class="nav-list">
                    <li><a href="index.php#home" class="nav-link">Home</a></li>
                    <li><a href="index.php#about" class="nav-link">About</a></li>
                    <li><a href="index.php#classes" class="nav-link">Classes</a></li>
                    <li><a href="index.php#trainers" class="nav-link">Trainers</a></li>
                    <li><a href="index.php#pricing" class="nav-link">Pricing</a></li>
                    <li><a href="index.php#contact" class="nav-link">Contact</a></li>
                </ul>

                <div class="nav-actions">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        ?>

                        <div class="profile-menu">
                            <img src="assets/image/profile.jpg" class="profile-icon" onclick="toggleMenu()">

                            <div id="profileDropdown" class="dropdown-menu">
                                <div class="dropdown-username"><?php echo $_SESSION['fullname']; ?></div>
                                <div class="dropdown-divider"></div>
                                <a href="profile.php">My Profile</a>
                                <a href="settings.php">Settings</a>
                                <a href="backend/logout.php" class="logout">Logout</a>
                            </div>
                        </div>

                        <?php
                    } else {
                        ?>
                        <a href="login.php" class="btn btn-outline">Login</a>
                        <a href="register.php" class="btn btn-primary">Join Now</a>

                        <?php
                    }
                    ?>
                </div>

            </nav>
            <button class="menu-toggle" id="menuToggle">
                <span class="menu-toggle-bar"></span>
                <span class="menu-toggle-bar"></span>
                <span class="menu-toggle-bar"></span>
            </button>
        </div>
    </div>
</header>