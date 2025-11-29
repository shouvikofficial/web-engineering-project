<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiuGym Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                include '../includes/admin_sidebar.php';
            } elseif ($_SESSION['role'] === 'member') {
                include '../includes/user_sidebar.php';
            }
        }
        ?>
        <div class="main-content">
            <header class="top-bar">
                <div class="user-welcome">
                    <strong>DiuGym</strong>
                </div>
                <div class="user-actions">
                    <span>Welcome, <?php echo isset($_SESSION['full_name']) ? htmlspecialchars($_SESSION['full_name']) : 'User'; ?></span>
                    <a href="../../backend/logout.php" class="btn-danger" style="margin-left: 15px;">Logout</a>
                </div>
            </header>
            <div class="page-content">
