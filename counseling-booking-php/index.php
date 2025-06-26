<?php
require_once 'includes/header.php';
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<div class="p-5 mb-4 bg-light rounded-3" style="background-image: url('https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg'); background-size: cover; background-position: center;">
    <div class="container-fluid py-5 text-white" style="background: rgba(0,0,0,0.5);">
        <h1 class="display-5 fw-bold">Welcome to Counseling Booking</h1>
        <p class="col-md-8 fs-4">Book your session with expert psychologists easily.</p>
        <a href="login.php" class="btn btn-primary btn-lg me-2">Login</a>
        <a href="register.php" class="btn btn-secondary btn-lg">Register</a>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
