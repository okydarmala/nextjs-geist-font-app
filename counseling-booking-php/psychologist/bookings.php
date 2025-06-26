<?php
require_once '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isPsychologist()) {
    redirect('../login.php');
}

$psychologist_id = $_SESSION['user_id'];

// Fetch bookings for this psychologist
$stmt = $pdo->prepare("SELECT b.id, u.name AS customer_name, b.date, b.time, b.status FROM bookings b JOIN users u ON b.customer_id = u.id WHERE b.psychologist_id = ? ORDER BY b.date DESC, b.time DESC");
$stmt->execute([$psychologist_id]);
$bookings = $stmt->fetchAll();
?>
<div class="container">
    <h2>Your Bookings</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?php echo htmlspecialchars($booking['id']); ?></td>
                <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['date']); ?></td>
                <td><?php echo htmlspecialchars($booking['time']); ?></td>
                <td><?php echo htmlspecialchars($booking['status']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once '../includes/footer.php'; ?>
