<?php
	session_start();
	include("../dbh/dbh.php");
	if (isset($_POST['addBalance'])){
		$id = $_POST['id'];
		$balance = $_POST['balance'];
		$confirmbalance = $_POST['confirmBalance'];
		if ($balance == $confirmbalance){
			$mysqli->query("UPDATE customer SET cus_balance=cus_balance+$balance WHERE cus_id='$id'") or die($mysqli->error);
			$_SESSION['message'] = $balance.' baht added succesfully to customer Id '.$id;
			$_SESSION['alert'] = 'success';
			header("Location: cashier_index.php");
		}
		else{
			$_SESSION['message'] = 'Balance and Confirm Balance not matching!';
			$_SESSION['alert'] = 'danger';
			header("Location: cashier_index.php");
		}
	}
?>