<?php
session_start();

date_default_timezone_set('Asia/Kolkata');

if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header('location: login.php');
    exit;
}

require_once 'db.php';

// Get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Update last login time
$last_login_at = date('Y-m-d H:i:s');
$stmt = $pdo->prepare("UPDATE users SET last_login_at = ? WHERE id = ?");
$stmt->execute([$last_login_at, $_SESSION['user_id']]);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome <?php echo $user['username']; ?>!</h1>
        <p>Your email is <?php echo $user['email']; ?></p>
        <p>Your last login was at <?php echo $user['last_login_at']; ?></p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <!-- Add Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSbNIV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

