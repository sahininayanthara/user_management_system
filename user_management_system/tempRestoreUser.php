
<?php session_start(); ?>
<?php 
	require_once('include/connection.php');
 ?>
 <?php if(!isset($_SESSION['user_id'])){
 	header('Location: index.php');
 }

if (isset($_GET['user_id'])) {
		$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

		$query = "UPDATE user SET is_deleted = 0 WHERE id = $user_id LIMIT 1";

		$result = mysqli_query($conn, $query);

		if ($result) {
			header('Location: users.php?msg=user-restore');
		}
		else {
				header('Location: restoreUser.php?err=restore-failed');
		}
	}

	else {
		header('Location: restoreUser.php');
	}
 
  ?>