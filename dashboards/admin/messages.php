<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

include '../includes/header.php';
?>

<h2>Contact Messages</h2>

<br>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Submitted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // IMPORTANT: Change table name if needed!
            $query = "SELECT * FROM messages ORDER BY id ASC";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['message'] . "</td>";
                    echo "<td>" . $row['submitted_at'] . "</td>";
                    echo "<td>
                            <a style='color:red;' href='delete_message.php?id=" . $row['id'] . "' 
                               onclick='return confirm(\"Delete this message?\")'>
                               Delete
                            </a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No messages found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
