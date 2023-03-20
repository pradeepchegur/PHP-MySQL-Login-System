<?php
session_start();

date_default_timezone_set('Asia/Kolkata');


if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    header('location: dashboard.php');
    exit;
}

require_once 'db.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
		$user_id = $_SESSION['user_id'];
        $last_login_at = date('Y-m-d H:i:s', strtotime(gmdate('Y-m-d H:i:s')) + 5.5 * 3600); // IST offset is +5.5 hours
        $stmt = $pdo->prepare("UPDATE users SET last_login_at = ? WHERE id = ?");
        $stmt->execute([$last_login_at, $user['id']]);
		$login_time = date('Y-m-d H:i:s'); // Get the current time in the user's timezone
		$stmt = $pdo->prepare("INSERT INTO user_logins (user_id, login_time) VALUES (?, ?)");
		$stmt->execute([$user_id, $login_time]);
        header('location: dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
        }
        .container {
            margin-top: 50px;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        button[type="submit"] {
            margin-top: 20px;
            width: 100%;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
        <a href="register.php">Don't have an account? Register here.</a>
        <a href="index.php">Go back to Main Page</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>



