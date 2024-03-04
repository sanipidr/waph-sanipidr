<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	session_start();    
	if (checklogin_mysql($_POST["username"],$_POST["password"])) {
?>
	<h2> Welcome <?php echo $_POST['username']; ?> !</h2>
<?php		
	}else{
		echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
		die();
	}
	function checklogin_mysql($username, $password) {
		$mysqli = new mysqli('localhost','sanipidr' /*Database username*/, 'Pa$$w0rd' /*Database password*/, 'waph' /*Database name*/);
		if($mysqli->connect_errno){
			printf("Database connection failed: %s\n", $mysqli->connect_error);
			exit();
  	    }
  	    $prepared_sql = "SELECT * FROM users WHERE username=? " . " AND password=md5(?);";
	    $stmt = $mysqli->prepare($prepared_sql);
	    $stmt->bind_param("ss", $username,$password);
	    $stmt->execute();
	    if($stmt->error){
            echo "Error: ".$stmt->error;
        exit();
        }
	    $result=$stmt->get_result();
	    if($result->num_rows ==1)
	        return TRUE;
	    return False;

	}
?>

