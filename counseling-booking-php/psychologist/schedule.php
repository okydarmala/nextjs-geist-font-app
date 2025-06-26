<?php
require_once '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isPsychologist()) {
    redirect('../login.php');
}
?>
<div class="container">
    <h2>Manage Schedule</h2>
    <p>This is a placeholder page for psychologists to manage their schedules.</p>
    <!-- Implement schedule management form and list here -->
</div>
<?php require_once '../includes/footer.php'; ?>
