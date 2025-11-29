<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}

include '../includes/header.php';
?>

<h2>Manage Members</h2>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Membership Plan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT u.id, u.fullname, u.email, u.phone, p.plan_name as plan_name 
                      FROM users u 
                      LEFT JOIN subscriptions s ON u.id = s.user_id AND s.status = 'Active' 
                      LEFT JOIN pricing_plans p ON s.plan_id = p.id 
                      WHERE u.role='member'";
            
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $plan = $row['plan_name'] ? $row['plan_name'] : '<span style="color: #999;">No Active Plan</span>';
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>" . $plan . "</td>";
                    echo "<td>
                            <a href='../../backend/admin_controller.php?delete_user=" . $row['id'] . "' 
                               class='btn-danger' 
                               onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No members found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
