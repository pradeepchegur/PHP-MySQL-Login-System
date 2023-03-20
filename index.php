<?php
session_start();

if(isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>RD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('img20190617150816023861507.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        form {
            text-align: center;
            margin-top: 30px;
        }
        input[type=submit] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #0069d9;
        }
        p {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Railway Department</h1>
    <?php if(isset($_SESSION['error'])) { ?>
        <p><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>
    <form action="login.php" method="POST">
        <input type="submit" value="Click here for Login or Registration">
    </form>
</body>
</html>

