<?php
require_once '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isCustomer()) {
    redirect('../login.php');
}

// Fetch psychologists for dropdown
$stmt = $pdo->query("SELECT id, name FROM psychologists ORDER BY name ASC");
$psychologists = $stmt->fetchAll();

$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $psychologist_id = intval($_POST['psychologist_id'] ?? 0);
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $notes = sanitizeInput($_POST['notes'] ?? '');

    if (!$psychologist_id || !$date || !$time) {
        $error = "Please fill in all required fields.";
    } else {
        // Insert booking
        $stmt = $pdo->prepare("INSERT INTO bookings (customer_id, psychologist_id, date, time, notes, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        if ($stmt->execute([$_SESSION['user_id'], $psychologist_id, $date, $time, $notes])) {
            $success = "Booking request submitted successfully.";
        } else {
            $error = "Failed to submit booking. Please try again.";
        }
    }
}
?>
<div class="container">
    <h2>Book a Counseling Session</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form method="post" action="booking.php">
        <div class="mb-3">
            <label for="psychologist_id" class="form-label">Select Psychologist</label>
            <select class="form-select" id="psychologist_id" name="psychologist_id" required>
                <option value="">Choose...</option>
                <?php foreach ($psychologists as $psychologist): ?>
                    <option value="<?php echo htmlspecialchars($psychologist['id']); ?>"><?php echo htmlspecialchars($psychologist['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required />
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" id="time" name="time" required />
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Additional Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Book Session</button>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>
