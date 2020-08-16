<?php
session_start();
include('../dbh/dbh.php');
if (isset($_POST['cus_create'])) {
	$name = $_POST['name'];
	$id = $_POST['id'];
	$email = $_POST['email'];
	$password = $_POST['pwd'];
	$confirmpassword = $_POST['confirmPwd'];
	$balance = 0;

	if (empty($name) || empty($id) || empty($email) || empty($password) || empty($confirmpassword)) {
		$_SESSION['message'] = 'You cannot leave the fields empty!';
		$_SESSION['alert'] = 'danger';
		header("Location: cus_createAccount.php");
	}
	else{
		if ($password !== $confirmpassword) {
			$_SESSION['message'] = "Passwords do not match!";
			$_SESSION['alert'] = "danger";
			header("Location: cus_createAccount.php");
		}
		else {
			$sql = "SELECT cus_id FROM customer WHERE cus_id=?";
			$stmt = mysqli_stmt_init($mysqli);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
			 	header("Location: cus_createAccount.php?error=sqlerror");
				exit();
			} 
			else {
				mysqli_stmt_bind_param($stmt, "i", $id);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck > 0) {
					$_SESSION['message'] = 'Id already taken!';
					$_SESSION['alert'] = 'danger';
					header("Location: cus_createAccount.php");
					exit();
				}
				else {
					$sql = "INSERT INTO customer (cus_id, cus_name, cus_email, cus_pwd, cus_balance) values (?,?,?,?,?)";
					$stmt = mysqli_stmt_init($mysqli);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
			 			header("Location: cus_createAccount.php?error=sqlerror");
						exit();
					}
					else {
						mysqli_stmt_bind_param($stmt, "isssi", $id, $name, $email, $password, $balance);
						mysqli_stmt_execute($stmt);
						$_SESSION['message'] = 'Account created successfully!';
						$_SESSION['alert'] = 'success';
						header("Location: cus_createAccount.php?signup=success");
					} 
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($mysqli);
}


