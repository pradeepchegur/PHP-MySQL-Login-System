<?php
session_start();

date_default_timezone_set('Asia/Kolkata');


if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header('location: login.php');
    exit;
}

require_once 'db.php';

$user_id = $_SESSION['user_id'];
$last_logout_at = date('Y-m-d H:i:s', strtotime(gmdate('Y-m-d H:i:s')) + 5.5 * 3600); // IST offset is +5.5 hours
$stmt = $pdo->prepare("UPDATE users SET last_logout_at = ? WHERE id = ?");
$stmt->execute([$last_logout_at, $user_id]);
$logout_time = date('Y-m-d H:i:s'); // Get the current time in the user's timezone
$stmt = $pdo->prepare("UPDATE user_logins SET logout_time = ? WHERE user_id = ? AND logout_time IS NULL ORDER BY login_time DESC LIMIT 1");
$stmt->execute([$logout_time, $user_id]);

session_unset();
session_destroy();

header('location: login.php');
exit;
?>

