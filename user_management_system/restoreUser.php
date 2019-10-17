<?php session_start(); ?>
<?php 
	require_once('include/connection.php');
 ?>
 <?php if(!isset($_SESSION['user_id'])){
 	header('Location: index.php');

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
		<h1 style="font-weight: bold;">Deleted Users<span><a href="users.php " style="font-size: 20px;text-decoration: none;"> < Back to User List</a></span></h1>
		<table class="table  table-hover" >
			<th style="border-bottom: 1px solid #aaa; background-color: #aaa">First Name</th>
			<th style="border-bottom: 1px solid #aaa; background-color: #aaa">Last Name</th>
			<th style="border-bottom: 1px solid #aaa; background-color: #aaa">Last Login</th>
			<th style="border-bottom: 1px solid #aaa; background-color: #aaa">Restore</th>
			<tr>
				
				<?php 
				$query = "SELECT * FROM user WHERE is_deleted = 1 ORDER BY first_name";
				$users = mysqli_query($conn, $query);
				if ($users) {
					while ($user = mysqli_fetch_array($users)){
					?>
						<div>
						<td style="border-bottom: 1px solid #aaa"><?php echo $user['first_name'] ?></td>
						<td style="border-bottom: 1px solid #aaa"><?php echo $user['last_name'] ?></td>
						<td style="border-bottom: 1px solid #aaa"><?php echo $user['last_login'] ?></td>
						<td style="border-bottom: 1px solid #aaa"><a href="tempRestoreUser.php?user_id=<?php echo $user['id'] ?>" style = "text-decoration: none;" >Restore</a></td>
						
						</div>
			</tr>
			
			<?php
					}
			
				} else{
				echo "Database query failed";

			}


				 ?>
			</tr>
			</table>



		</div>
 </body>
 </html>