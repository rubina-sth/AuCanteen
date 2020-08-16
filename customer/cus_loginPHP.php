<?php
session_start();
include('../dbh/dbh.php');
if (isset($_POST['cus_login'])) {

	$id = $_POST['id'];
	$password = $_POST['pwd'];

	if (empty($id) || empty($password)) {
		$_SESSION['message'] = 'You cannot leave the feilds empty!';
		$_SESSION['alert'] = 'danger';
		header("Location: cus_login.php?error=emptyfields");
		exit();
	}
	else {
		$sql = "SELECT * FROM customer WHERE cus_id=?";
		$stmt = mysqli_stmt_init($mysqli);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: cus_login.php?error=sqlerror");
			exit();
		}	
		else {
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				// $pwdCheck = password_verify($password, $row['aPassword']);
				if ($password !== $row['cus_pwd']) {
					$_SESSION['message'] = 'Wrong Password!';
					$_SESSION['alert'] = 'danger';
					header("Location: cus_login.php?error=wrongpassword");
					exit();
				}
				else if ($password == $row['cus_pwd']) {
					session_start();
					$_SESSION['id'] = $row['cus_id']; 
					header("Location: cus_index.php?login=success");
				}
			}
			else {
				$_SESSION['message'] = 'User not found!';
				$_SESSION['alert'] = 'danger';
				header("Location: cus_login.php?error=nouser");
				exit();
			}
		}
	}
}
else if (isset($_POST['cus_logout'])){
	session_start();
	session_destroy();
	unset($_SESSION['id']);
	header("Location: cus_login.php");
}