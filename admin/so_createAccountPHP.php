<?php
session_start();
include('../dbh/dbh.php');
if (isset($_POST['so_create'])) {
	$name = $_POST['name'];
	$id = $_POST['id'];
	$shopName = $_POST['shopName'];
	$password = $_POST['pwd'];
	$confirmpassword = $_POST['confirmPwd'];

	if (empty($name) || empty($id) || empty($shopName) || empty($password) || empty($confirmpassword)) {
		$_SESSION['message'] = 'You cannot leave the fields empty!';
		$_SESSION['alert'] = 'danger';
		header("Location: so_createAccount.php");
	}
	else{
		if ($password !== $confirmpassword) {
			$_SESSION['message'] = "Passwords do not match!";
			$_SESSION['alert'] = "danger";
			header("Location: so_createAccount.php");
		}
		else {
			$sql = "SELECT so_id FROM shopowner WHERE so_id=?";
			$stmt = mysqli_stmt_init($mysqli);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
			 	header("Location: so_createAccount.php?error=sqlerror");
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
					header("Location: so_createAccount.php");
					exit();
				}
				else {
					$sql = "INSERT INTO shopowner (so_id, so_name, so_pwd) values (?,?,?)";
					$sql1 = "INSERT INTO shop (shop_name, so_id) values (?,?)";
					$stmt = mysqli_stmt_init($mysqli);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
			 			header("Location: so_createAccount.php?error=sqlerror");
						exit();
					}
					else {
						mysqli_stmt_bind_param($stmt, "iss", $id, $name, $password);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_prepare($stmt,$sql1);
						mysqli_stmt_bind_param($stmt, "si", $shopName, $id);
						mysqli_stmt_execute($stmt);
						$_SESSION['message'] = 'Account created successfully!';
						$_SESSION['alert'] = 'success';
						header("Location: so_createAccount.php?signup=success");
					} 
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($mysqli);
}


