<?php
// Establish database connection


$conn = new mysqli('localhost','dilip','12345' ,'waph_dilip' );

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the provided username exists in the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
    $username = $_POST["username"];

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username exists
        echo "exists";
    } else {
        // Username doesn't exist
        echo "not exists";
    }
}

// Close database connection
$conn->close();
?>
