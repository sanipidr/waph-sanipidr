<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAPH-Registration Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <form action="addnewuser.php" method="POST" class="form login mt-5">
        <div class="container">
            <h1 class="text-center mb-4">User Registration Form</h1>
            
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name" required>
            </div>
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required>
                <span id="username-error" class="text-danger" style="display: none;">Username already exists. Please choose a different one.</span>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter a valid email" required pattern="^[\w.-]+@[\w-]+(\.[\w-]+)*$" title="Enter a valid email">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&])[A-Za-z\d!@#$%^&]{8,}$" title="Password must have at least 8 characters with 1 special symbol !@#$%^&, 1 number, 1 lowercase, and 1 UPPERCASE">
            </div>
            
            <div class="form-group">
                <label for="repassword">Retype Password:</label>
                <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Retype your password" required title="Password does not match" onchange="validatePassword()">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript for checking username availability and password match
        document.getElementById("username").addEventListener("change", function() {
            var username = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "check_username.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText === "exists") {
                        document.getElementById("username-error").style.display = "inline";
                    } else {
                        document.getElementById("username-error").style.display = "none";
                    }
                }
            };
            xhr.send("username=" + username);
        });

        function validatePassword() {
            var password = document.getElementById("password").value;
            var repassword = document.getElementById("repassword").value;
            if (password !== repassword) {
                document.getElementById("repassword").setCustomValidity("Passwords don't match");
            } else {
                document.getElementById("repassword").setCustomValidity('');
            }
        }
    </script>
</body>
</html>
