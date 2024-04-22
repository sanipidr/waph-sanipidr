<?php
// Establish database connection


$conn = new mysqli('localhost','dilip','12345' ,'waph_dilip' );

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle user registration
function registerUser($username, $password, $name, $email) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (username, password, name, email) VALUES (?, md5(?), ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $name, $email);
    return $stmt->execute();
}

// Function to handle user login
function loginUser($username, $password) {
    global $conn;
    $sql= "SELECT * FROM users WHERE username=? AND password=md5(?)";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss",$username, $password);
        $stmt->execute();
        $result=$stmt->get_result();    
        if($result->num_rows ==1)
            return TRUE;
        return false;

}

function changePassword1($username, $new_password) {
    global $conn;
    
    $stmt = $conn->prepare("UPDATE users SET password = md5(?) WHERE username = ?");
    $stmt->bind_param("ss", $new_password, $username);
    if($stmt->execute())    return TRUE;
    return false;
    }




// Close database connection
function closeConnection() {
    global $conn;
    $conn->close();
}
?>
