<?php
require "session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit User Profile - WAPH</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript">
        function displayTime() {
            document.getElementById('digit-clock').innerHTML = "Current time: " + new Date();
        }
        setInterval(displayTime, 500);
    </script>
</head>
<body>

<div class="container mt-5">
    <form action="edituserprofile.php" method="POST" class="form login">
        <h1 class="text-center mb-4">Edit User Profile Form</h1>
        <input type="hidden" name="username" value="<?php echo htmlentities($_SESSION["username"]);?>"/><br>
        <div class="form-group">
            <label for="name">Type the New Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="email">New Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="phone">New Phone:</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter phone">
        </div>
         <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>"/>
        <button class="btn btn-primary btn-block" type="submit">Submit</button>
    </form>
</div>

<div class="container mt-3">
    <div id="digit-clock"></div>
    <?php
    $rand = bin2hex(openssl_random_pseudo_bytes(16));
    $_SESSION['nocsrftoken'] = $rand;
    echo "Visited time: " . date("Y-m-d h:i:sa")
    ?>
   
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
