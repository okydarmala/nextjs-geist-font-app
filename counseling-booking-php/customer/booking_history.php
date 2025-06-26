<?php
require_once '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isCustomer()) {
    redirect('../login.php');
}

$customer_id = $_SESSION['user_id'];

// Fetch bookings for this customer
$stmt = $pdo->prepare("SELECT b.id, p.name AS psychologist_name, b.date, b.time, b.status FROM bookings b JOIN psychologists p ON b.psychologist_id = p.id WHERE b.customer_id = ? ORDER BY b.date DESC, b.time DESC");
$stmt->execute([$customer_id]);
$bookings = $stmt->fetchAll();
?>
<div class="container">
    <h2>Your Booking History</h2>
    <?php if (empty($bookings)): ?>
        <p>You have no bookings yet.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Psychologist</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['psychologist_name']); ?></td>
                    <td><?php echo htmlspecialchars($booking['date']); ?></td>
                    <td><?php echo htmlspecialchars($booking['time']); ?></td>
                    <td><?php echo htmlspecialchars($booking['status']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php require_once '../includes/footer.php'; ?>
