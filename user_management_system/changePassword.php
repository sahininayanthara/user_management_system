<?php session_start(); ?>
<?php 
	require_once('include/connection.php');
 ?>


<?php
if(!isset($_SESSION['user_id'])){
 	header('Location: index.php');
 }

	$errors = array();
	$user_id    = '';
	$first_name = '';
	$last_name  = '';
	$email      = '';
	$password   = '';
	
	if (isset($_GET['user_id'])) {
		//getting the user information
		$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
		$query = "SELECT * FROM user WHERE id = {$user_id} LIMIT 1";

		$result_set = mysqli_query($conn, $query);
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				//user found
				$result = mysqli_fetch_assoc($result_set);
				$first_name = $result['first_name'];
				$last_name  = $result['last_name'];
				$email      = $result['email'];


			}else{
				//user not found
				header('Location: users.php?err=user_not_found');
			}
		}else{
			//query unsuccessful
			header('Location: users.php?err=query_failed');
		}
	}
	 
	if (isset($_POST['submit'])) {
		$user_id    = $_POST['user_id'];
		$password = $_POST['password'];
		
		$req_field = array('user_id', 'password');
		foreach ($req_field as $field) {
			
			if (empty(trim($_POST[$field]))) {
		$errors[] = $field .' is required';
	}
		}


		 if (empty($errors)) {
		  	//no errors found... updating the record
		  	$password = mysqli_real_escape_string($conn, $_POST['password']);
		  	$hashed_password = sha1($password);
		  	
		  	$query = "UPDATE user SET password = '{$hashed_password}' WHERE id = {$user_id} LIMIT 1 ";
		  	$result = mysqli_query($conn, $query);


		  	if ($result) {
		  		//query successful... redirecting to users page
		  		header('Location: users.php?changed_password=true');
		  	}else{


		  		$errors[] = 'Failed to update the password.';
		  	}

		  } 
} 
?>

 <!DOCTYPE html>
 <html>
<head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
 	<style type="text/css">
 		body{

 			background-color: lightblue;
 		}
 	</style>
 </head>




 <body>
 	<header>
 	<div class="float-left ml-2 mt-1">User Management System</div> 
 	<div class="float-right">Welcome <?php echo $_SESSION['first_name']; ?>!&nbsp;&nbsp;<a href="logout.php"><button class="btn btn-primary mr-2 mt-1"> log Out</button></a></div>
 	</header>	
 
 	<br><br>
	<div class="container">
		<h1 style="font-weight: bold;margin-left: 270px;">Change Password<span><a href="users.php " style="font-size: 20px;text-decoration: none;"> < Back to User List</a></span></h1>
	
		<div class="row">
			<div class="col-md-6" style="max-width: 1000px;margin-left: 270px;">
				<form action="changePassword.php" method="post">

<div class="text-danger">
<?php 

	if (!empty($errors)) {
		foreach ($errors as $error) {
			$error = ucfirst(str_replace("_", " ", $error));
			echo $error ?> <br> <?php ;
		}
	}
 ?></div>
 					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					<div class="form-group">
						<label>First Name: </label>
						<input type="text" name="first_name" class="form-control"<?php echo 'value="' . $first_name . '"'; ?> disabled>
					</div>
					
					<div class="form-group">
						<label>Last Name: </label>
						<input type="text" name="last_name" class="form-control"<?php echo 'value="' . $last_name . '"'; ?> disabled>
					</div>

					<div class="form-group">
						<label>Email: </label>
						<input type="email" name="email"    class="form-control"<?php echo 'value="' . $email . '"'; ?> disabled>
					</div>

					<div class="form-group">
						<label for="">New Password: </label>
						<input type="password" name="password" id="password" class="form-control">
					</div>
					
						<button class="btn btn-primary" type="submit" name="submit">Update Password</button>
				</form>
		
			</div>

		</div>
	</div>
 </body>
 </html>