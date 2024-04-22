   <?php
 $lifetime=15*60;
    $path="/";
    $domain="192.167.4.181";
    $secure=TRUE;
    $httponly=TRUE;
    session_set_cookie_params($lifetime,$path,$domain,$secure,$httponly);
    session_start();   
     if(!$_SESSION["authenticated"] or $_SESSION["authenticated"] !=TRUE){
      session_destroy();
      echo "<script>alert('You are not registered. Please registered again');</script>";
      header("Refresh:0; url=loginform.php");
      die();
    }
    if($_SESSION['browser'] !=$_SERVER['HTTP_USER_AGENT']){
      session_destroy();
      echo "<script>alert('Session hijacking attack is detected!');</script>";
      header("Refesh:0; url=loginform.php");
      die();
      
    }
    ?>
