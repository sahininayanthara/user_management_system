<?php session_start(); ?>
<?php 
	require_once('include/connection.php');
 ?>
 <?php 

 	if(isset($_POST['submit'])){
 		$errors = array();
 		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){
 			$errors[] = 'Email is Missing / Invalid';
 		}

 		if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){
 			$errors[] = 'Password is Missing / Invalid';
 		}


 		if (empty($errors)) {
 			$email    = mysqli_real_escape_string($conn, $_POST['email']);
 			$password = mysqli_real_escape_string($conn, $_POST['password']);
 			$hashed_password = sha1($password);

 			$query = " SELECT * FROM user WHERE email = '{$email}' AND password = '{$hashed_password}' LIMIT 1";
 			
 			$result = mysqli_query($conn, $query);

 			if($result){

 				if(mysqli_num_rows($result) == 1){
 					$user = mysqli_fetch_assoc($result);
 					$_SESSION['user_id'] = $user['id'];
 					$_SESSION['first_name'] = $user['first_name'];
 			// updating last login
 					$query      = "UPDATE user SET last_login = NOW() WHERE id = {$_SESSION['user_id']} LIMIT 1";
 					$result_set = mysqli_query($conn, $query);

 					if (!$result_set) {
 						die("Database query failed");
 					}


 					header('Location: users.php');

 				}else{
 					$errors[] = 'Invalid Email / Password';
 				}
 					}
 				else{
 					$errors[] = 'Database query failed';
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
			background-image: url(images/1.jpg);
			background-repeat: no-repeat;
			background-size: cover;
 		}
 	</style>

 </head>



<body>

<div class="container">
<div class="login-box" style="margin:150px auto;">
<div class="row">
<div class="col-md-6 m-auto d-block">
	<div class="card">
		<h2 class="text-center card-header">Login Here</h2>
		<form action="index.php" method="post">
		<div class="card-body">
			<div class="text-danger"><?php 
				if(isset($errors) && !empty($errors)) {
					echo "Invalid Email / Password";
				}

			 ?></div>
			<div class="form-group">
				
				<label>Email</label>
				<input type="text" name="email" class="form-control bg-transparent" >
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control bg-transparent">
				
			</div>
		</div>
		<div class="card-footer">
			<div class="text-center">
			<button type="submit" name="submit" class="btn btn-primary btn-ghost btn-ghost-bordered center-block" style ="width:115px;">Login</button>
			</div>
		</div>
		</form>
	</div>
	
</div>	
</div>
</div>
</div>

</body>
</html>


 

  <?php 
	mysqli_close($conn);
 ?>