<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	session_start();  
	if (isset($_POST["username"] and issest($_POST["password"])) {

		if (checklogin_mysql($_POST["username"],$_POST["password"])) {
    ?>

	  <h2> Welcome <?php echo htmlentities($_POST['username']); ?> !</h2>
    <?php		
	    }else{
		     echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
		     die();
		}
    }   
	function checklogin_mysql($username, $password) {
		$mysqli = new mysqli('localhost','sanipidr' /*Database username*/, 'Pa$$w0rd' /*Database password*/, 'waph' /*Database name*/);
		if($mysqli->connect_errno){
			printf("Database connection failed: %s\n", $mysqli->connect_error);
			exit();
  	    }
  	    $sql = "SELECT * FROM users WHERE username='" . $username . "' ";
	    $sql = $sql . " AND password = md5('" . $password . "')";
	    //echo "DEBUG>sql = $sql"; //return TRUE;
	    $result = $mysqli->query($sql);
	    
	    if($result->num_rows ==1)
	        return TRUE;
	    return False;

	}
?>
