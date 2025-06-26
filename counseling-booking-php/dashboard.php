<?php
require_once 'includes/header.php';
require_once 'includes/functions.php';
if (!isLoggedIn()) {
    redirect("login.php");
}
$role = $_SESSION['role'];
?>
<div class="text-center">
    <h1>Dashboard</h1>
    <p>Welcome, you are logged in as a <?php echo htmlspecialchars($role); ?>.</p>
    <?php if ($role == 'admin'): ?>
        <a href="/admin/manage_users.php" class="btn btn-warning mb-2">Manage Users</a>
        <a href="/admin/manage_bookings.php" class="btn btn-warning mb-2">Manage Bookings</a>
        <a href="/admin/manage_psychologists.php" class="btn btn-warning mb-2">Manage Psychologists</a>
    <?php elseif ($role == 'psychologist'): ?>
        <a href="/psychologist/schedule.php" class="btn btn-info mb-2">Manage Schedule</a>
        <a href="/psychologist/bookings.php" class="btn btn-info mb-2">View Bookings</a>
    <?php elseif ($role == 'customer'): ?>
        <a href="/customer/booking.php" class="btn btn-success mb-2">Book a Session</a>
        <a href="/customer/booking_history.php" class="btn btn-success mb-2">Booking History</a>
    <?php endif; ?>
</div>
<?php require_once 'includes/footer.php'; ?>
