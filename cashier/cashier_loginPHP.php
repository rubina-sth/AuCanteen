<?php
session_start();
include('../dbh/dbh.php');
if (isset($_POST['cashier_login'])) {

	$id = $_POST['id'];
	$password = $_POST['pwd'];

	if (empty($id) || empty($password)) {
		$_SESSION['message'] = 'You cannot leave the feilds empty!';
		$_SESSION['alert'] = 'danger';
		header("Location: index.php?error=emptyfields");
		exit();
	}
	else {
		$sql = "SELECT * FROM cashier WHERE cashier_id=?";
		$stmt = mysqli_stmt_init($mysqli);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: index.php?error=sqlerror");
			exit();
		}	
		else {
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				// $pwdCheck = password_verify($password, $row['aPassword']);
				if ($password !== $row['cashier_pwd']) {
					$_SESSION['message'] = 'Wrong Password!';
					$_SESSION['alert'] = 'danger';
					header("Location: index.php?error=wrongpassword");
					exit();
				}
				else if ($password == $row['cashier_pwd']) {
					session_start();
					$_SESSION['cashier_id'] = $row['cashier_id']; 
					header("Location: cashier_index.php?login=success");
				}
			}
			else {
				$_SESSION['message'] = 'User not found!';
				$_SESSION['alert'] = 'danger';
				header("Location: index.php?error=nouser");
				exit();
			}
		}
	}
}
else if (isset($_POST['cashier_logout'])){
	session_start();
	session_destroy();
	unset($_SESSION['id']);
	header("Location: index.php");
}