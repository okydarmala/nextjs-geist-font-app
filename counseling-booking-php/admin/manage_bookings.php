<?php
require_once '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../login.php');
}

// Fetch all bookings with user and psychologist info
$sql = "SELECT b.id, u.name AS customer_name, p.name AS psychologist_name, b.date, b.time, b.status
        FROM bookings b
        JOIN users u ON b.customer_id = u.id
        JOIN psychologists p ON b.psychologist_id = p.id
        ORDER BY b.date DESC, b.time DESC";
$stmt = $pdo->query($sql);
$bookings = $stmt->fetchAll();
?>
<div class="container">
    <h2>Manage Bookings</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Psychologist</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <!-- Actions column can be added for update/delete -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?php echo htmlspecialchars($booking['id']); ?></td>
                <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['psychologist_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['date']); ?></td>
                <td><?php echo htmlspecialchars($booking['time']); ?></td>
                <td><?php echo htmlspecialchars($booking['status']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once '../includes/footer.php'; ?>
