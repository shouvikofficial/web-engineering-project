<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}

$sql = "SELECT * FROM messages ORDER BY submitted_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Messages</title>
    <link rel="stylesheet" href="../../assets/css/styles.css"> 
    <style>
        .admin-container { padding: 40px; max-width: 1200px; margin: 0 auto; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .msg-table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
        .msg-table th, .msg-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        .msg-table th { background-color: #333; color: #fff; text-transform: uppercase; font-size: 0.85rem; }
        .msg-table tr:hover { background-color: #f9f9f9; }
        .empty-state { text-align: center; padding: 40px; color: #666; }
        .btn-back { background: #555; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body class="bg-light">

    <div class="admin-container">
        <div class="page-header">
            <h2>User Messages</h2>
            <a href="index.php" class="btn-back">← Back to Dashboard</a>
        </div>

        <table class="msg-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date/Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td>
                                <a href="mailto:<?php echo $row['email']; ?>">
                                    <?php echo htmlspecialchars($row['email']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo date('M d, Y h:i A', strtotime($row['submitted_at'])); ?></td>
                            <td>
                                <a href="#" style="color: red; font-size: 0.9rem;">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state">No messages found yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>