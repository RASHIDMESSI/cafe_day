<?php
// Including the constant file
include('../frontend/config/constants.php');

// Check if the user is already logged in
if (isset($_SESSION['user-admin'])) {
    header('location:' . SITEURL . 'index.php');
    exit();
}

$login_error = '';
$debug_info = '';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Use MD5 for now

    $sql = "SELECT * FROM tbl_admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user-admin'] = $username;
        header('location:' . SITEURL . 'index.php');
        exit();
    } else {
        $login_error = "Invalid Username or Password";
        $debug_info .= "Login failed. Entered username: $username<br>";
    }
}

// Debugging: Check if the connection is successful
if (!$conn) {
    $debug_info .= "Database connection failed: " . mysqli_connect_error() . "<br>";
} else {
    $debug_info .= "Database connection successful.<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <link rel="icon" type="image/png" href="../images/logo1.png">
    <title>Admin Login</title>
    <style>
        .debug-info {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
            font-family: monospace;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">Admin Panel</div>
        
        <?php
        if (!empty($login_error)) {
            echo "<div class='error'>$login_error</div>";
        }
        ?>

        <form action="" class="inputs" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="submit">Login</button>
        </form>

        
    </div>
</body>
</html>