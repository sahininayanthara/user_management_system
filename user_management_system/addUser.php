<?php session_start(); ?>
<?php 
	require_once('include/connection.php');
 ?>


<?php
if(!isset($_SESSION['user_id'])){
 	header('Location: index.php');
 }

	$errors = array();
	$first_name = '';
	$last_name  = '';
	$email      = '';
	$password   = '';
	 
	if (isset($_POST['submit'])) {

		$first_name = $_POST['first_name'];
		$last_name  = $_POST['last_name'];
		$email      = $_POST['email'];
		$password   = $_POST['password'];





		$req_field = array('first_name', 'last_name', 'email', 'password' );

		foreach ($req_field as $field) {
			
			if (empty(trim($_POST[$field]))) {
		$errors[] = $field .' is required';
	}
		}


		$email      = mysqli_real_escape_string($conn, $_POST['email']);
		$query      = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
		$result_set = mysqli_query($conn, $query);

		if ($result_set) {
		 	if (mysqli_num_rows($result_set) == 1) {
		 		$errors[] = 'Email Address is Already Exists';
		 	}
		 }

		 if (empty($errors)) {
		  	//no errors found... adding new record
		  	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
		  	
		  	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
		  	
		  	$password = mysqli_real_escape_string($conn, $_POST['password']);
		  	
		  	$hashed_password = sha1($password);

			

		  	$query = "INSERT INTO user(first_name, last_name, email, password, is_deleted) VALUES('$first_name', '$last_name', '$email', '$hashed_password', 0)";
		  	$result = mysqli_query($conn, $query);


		  	if ($result) {
		  		//query successful... redirecting to users page
		  		header('Location: users.php?user_added=true');
		  	}else{


		  		$errors[] = 'Failed to add the new record.';
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

 			background-color: gray;
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
		<h1 style="font-weight: bold;margin-left: 270px;">Add New User<span><a href="users.php " style="font-size: 20px;text-decoration: none;"> < Back to User List</a></span></h1>
	
		<div class="row">
			<div class="col-md-6" style="max-width: 1000px;margin-left: 270px;">
				<form action="addUser.php" method="post">

<div class="text-danger">
<?php 

	if (!empty($errors)) {
		foreach ($errors as $error) {
			$error = ucfirst(str_replace("_", " ", $error));
			echo $error ?> <br> <?php ;
		}
	}
 ?></div>

					<div class="form-group">
						<label>First Name: </label>
						<input type="text" name="first_name" class="form-control"<?php echo 'value="' . $first_name . '"'; ?>>
					</div>
					
					<div class="form-group">
						<label>Last Name: </label>
						<input type="text" name="last_name" class="form-control"<?php echo 'value="' . $last_name . '"'; ?>>
					</div>

					<div class="form-group">
						<label>Email: </label>
						<input type="email" name="email"    class="form-control"<?php echo 'value="' . $email . '"'; ?>>
					</div>

					<div class="form-group">
						<label>Password: </label>
						<input type="text" name="password" class="form-control">
					</div>

						<button class="btn btn-primary" type="submit" name="submit">Submit</button>
				</form>
		
			</div>

		</div>
	</div>
 </body>
 </html>