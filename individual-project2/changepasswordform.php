<?php
require "session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Change Password Form - WAPH</title>
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

<div class="container">
    <form action="changepassword.php" method="POST" class="form login">
        <h1 class="text-center mb-4">Change Password Form, WAPH</h1>
        <input type="hidden" name="username" value="<?php echo htmlentities($_SESSION["username"]);?>"/>
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" class="form-control" required
                   placeholder="Enter new password" title="Password must have at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase, and 1 UPPERCASE"
                   onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); form.repassword.pattern = this.value;"/>
        </div>
        <div class="form-group">
            <label for="newpassword">Retype New Password:</label>
            <input type="password" name="newpassword" class="form-control" required
                   placeholder="Retype new password" title="Passwords do not match"
                   onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
        </div>
        <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>"/>
        <button class="btn btn-primary btn-block" type="submit">Submit</button>
    </form>
</div>

<div class="container">
    <div id="digit-clock"></div>
    <?php
    $rand = bin2hex(openssl_random_pseudo_bytes(16));
    $_SESSION["nocsrftoken"] = $rand;
    echo "Visited time: " . date("Y-m-d h:i:sa");
    ?>
    
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
