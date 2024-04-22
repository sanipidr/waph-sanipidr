<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Profile Result</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <?php
    $username = $_POST["username"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $token = $_POST['nocsrftoken'];

    if (!isset($token) || ($token != $_SESSION["nocsrftoken"])) {
        echo "<div class='alert alert-danger' role='alert'>CSRF Attack is detected</div>";
        die();
    }

    if (isset($username)) {
        if (editprofile($username, $name, $email, $phone)) {
            echo "<div class='alert alert-success' role='alert'>Profile updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Failed to update profile</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>No username provided</div>";
    }

    function editprofile($username, $name, $email, $phone) {

        $mysqli = new mysqli('localhost', 'dilip', '12345', 'waph_dilip');
        if ($mysqli->connect_errno) {
            printf("Database connection failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $prepared_sql = "UPDATE users SET name=?, email=?, phone=? WHERE username=?;";
        $stmt = $mysqli->prepare($prepared_sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $username);
        if ($stmt->execute()) return true;
        return false;
    }
    ?>
    <a href="loginform.php" class="btn btn-primary">Login</a>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
