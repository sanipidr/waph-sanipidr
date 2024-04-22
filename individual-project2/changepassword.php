<?php
$username = $_REQUEST['username'];
$newpassword = $_REQUEST['newpassword'];

$token = $_POST['nocsrftoken'];

if (!isset($token) || $token != $_SESSION["nocsrftoken"]) {
    echo "CSRF Attack is detected";
    die();
}

if (isset($username) && isset($newpassword)) {

    if (changepassword($username, $newpassword)) {
        $success_message = "Password changed successfully.";
    } else {
        $error_message = "Failed to change password.";
    }
} else {
    $error_message = "No username/password provided.";
}

function changepassword($username, $password) {

    $mysqli = new mysqli('localhost', 'dilip', '12345', 'waph_dilip');
    if ($mysqli->connect_errno) {
        printf("Database connection failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $prepared_sql = "UPDATE users SET password=md5(?) WHERE username=?;";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("ss", $password, $username);
    if ($stmt->execute()) return true;
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change Result - WAPH</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container mt-5">
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php elseif (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <a href="loginform.php" class="btn btn-primary">Login</a>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
