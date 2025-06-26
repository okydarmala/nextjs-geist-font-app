<?php
// config.php
$dsn = 'mysql:host=localhost;dbname=counseling_db;charset=utf8mb4';
$db_user = 'your_username';
$db_pass = 'your_password';

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the error and display a user-friendly message
    error_log($e->getMessage(), 3, __DIR__ . "/../logs/errors.log");
    die("Database connection failed. Please try again later.");
}
?>
