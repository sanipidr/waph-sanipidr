<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php
    
    
require "database.php";

    $lifetime=15*60;
    $path="/";
    $domain="192.168.86.22";
    $secure=TRUE;
    $httponly=TRUE;
    session_set_cookie_params($lifetime,$path,$domain,$secure,$httponly);
    session_start();   
    
    $username= $_POST["username"];
    $password= $_POST["password"];
    $name= $_POST["name"];
    $email= $_POST["email"];
    if(isset($username) and isset($password) and isset($name) and isset($email) ){

      if (addnewuser($username,$password,$name,$email)){
        $_SESSION['authenticated']=TRUE;
        $_SESSION['username']= $_POST["username"];
        $_SESSION['browser']=$_SESSION['HTTP_USER_AGENT'];
        echo "Congratulations! you have sucessfully registered in the system";
      }else{
        session_destroy();
        echo "Registration failed! please try again.";
        die();
      }
    }
    else{
      echo "No username/password provided.";
      
    }
    
    if(!isset($_SESSION['authenticated']) and $_SESSION['authenticated'] !=TRUE){
      session_destroy();
      echo "<script>alert('You are not registered. Please registered again');</script>";
      header("Refesh:0; url=registrationform.php");
      die();
    }
    if($_SESSION['browser'] !=$_SESSION['HTTP_USER_AGENT']){
      session_destroy();
      echo "<script>alert('Session hijacking attack is detected!');</script>";
      header("Refesh:0; url=registrationform.php");
      die();
      
    }
    
    function addnewuser($username, $password,$name,$email) {
      
      $mysqli = new mysqli('localhost','dilip','12345' ,'waph_dilip' );
      
      if($mysqli->connect_errno){
        printf("DB connection failed",$mysqli->connect_error);
        return false;
      }
      $result = registerUser($username, $password, $name, $email);

    if ($result) {
        echo "User registered successfully.";
        return true;
    } else {
        echo "Error: User registration failed.";
        return false;
    }
      
      
    }
    ?>
    <br/>
    <a href='loginform.php'>Login</a>
  </body>
  </html>