<?php
require_once '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../login.php');
}

// Fetch all psychologists
$stmt = $pdo->query("SELECT id, name, email, specialization FROM psychologists ORDER BY id DESC");
$psychologists = $stmt->fetchAll();
?>
<div class="container">
    <h2>Manage Psychologists</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Specialization</th>
                <!-- Actions column can be added for edit/delete -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($psychologists as $psychologist): ?>
            <tr>
                <td><?php echo htmlspecialchars($psychologist['id']); ?></td>
                <td><?php echo htmlspecialchars($psychologist['name']); ?></td>
                <td><?php echo htmlspecialchars($psychologist['email']); ?></td>
                <td><?php echo htmlspecialchars($psychologist['specialization']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once '../includes/footer.php'; ?>
