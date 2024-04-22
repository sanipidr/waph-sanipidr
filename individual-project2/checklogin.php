<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Processing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <?php
        require "database.php";

        $lifetime = 15 * 60;
        $path = "/";
        $domain = "192.168.86.22";
        $secure = TRUE;
        $httponly = TRUE;
        session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
        session_start();

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (checklogin_mysql($username, $password)) {
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
            ?>
            <div class="alert alert-success" role="alert">
                <h2 class="alert-heading">Welcome <?php echo htmlentities($_SESSION['username']); ?>!</h2>
                <hr>
                <p class="mb-0">You have successfully logged in.</p>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                <h2 class="alert-heading">Invalid Username/Password</h2>
                <hr>
                <p class="mb-0">Please try again.</p>
            </div>
            <?php
            header("refresh:2;url=loginform.php");
            die();
        }

        function checklogin_mysql($username, $password) {
            $mysqli = new mysqli('localhost', 'dilip', '12345', 'waph_dilip');

            if ($mysqli->connect_errno) {
                printf("DB connection failed", $mysqli->connect_error);
                exit();
            }
            $sql= "SELECT * FROM users WHERE username=? AND password=md5(?)";
        $stmt=$mysqli->prepare($sql);
        $stmt->bind_param("ss",$username, $password);
        $stmt->execute();
        $result=$stmt->get_result();    
        if($result->num_rows == 1)
            return TRUE;
        return false;
        }
        ?>
        <a href="logout.php" class="btn btn-primary">Logout</a>
        <a href="edituserprofileform.php" class="btn btn-secondary">Edit Profile</a>
        <a href="changepasswordform.php" class="btn btn-secondary">Change Password</a>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
