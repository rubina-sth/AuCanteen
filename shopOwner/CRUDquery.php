<?php		
	session_start();
	include("../dbh/dbh.php");

	if (isset($_POST['confirm'])) {
		$food_name = $_POST['food_name'];
		$price = $_POST['price'];
		$type = $_POST['type'];
		$description = $_POST['description'];
		$id = $_SESSION['shop_id'];
		$shop_name = $mysqli->query("SELECT shop_name FROM shopowner NATURAL JOIN shop WHERE so_id='$id'") or die($mysqli->error);

		$_SESSION['message'] = $food_name.' '."has been added succesfully!";
		$_SESSION['alert'] = "success";

		$mysqli->query("INSERT INTO food (food_name, price, type, description, availability, shop_name) VALUES('$food_name', '$price', '$type', '$description', 'yes', (SELECT shop_name FROM shopowner NATURAL JOIN shop WHERE so_id='$id'))") or die($mysqli->error);
		header("Location: modify_menu.php");
	}

	if (isset($_POST['deletedata'])){
		$id = $_POST['delete_id'];
		$mysqli->query("DELETE FROM food WHERE food_id='$id'") or die($mysqli->error);

		$_SESSION['message'] = "Item deleted successfully!";
		$_SESSION['alert'] = "danger";
		header("Location: modify_menu.php");
	}

	if (isset($_POST['save'])){
		$id = $_POST['update_id'];
		$food_name = $_POST['foodName'];
		$price = $_POST['foodPrice'];
		$type = $_POST['foodType'];
		$mysqli->query("UPDATE food SET food_name='$food_name', price='$price', type='$type' WHERE food_id='$id'") or die($mysqli->error);

		$_SESSION['message'] = "Food record has been updated!";
		$_SESSION['alert'] = "success";
		header("Location: modify_menu.php");
	}

	if (isset($_POST['availability'])){
		$id = $_POST['available'];
		$availability = $_POST['availability'];
		$mysqli->query("UPDATE food SET availability='$availability' WHERE food_id='$id'") or die($mysqli->error);

		$_SESSION['message'] = "Availability set to".' '.$availability;
		$_SESSION['alert'] = "success";
		header("Location: modify_menu.php");
	}

	if (isset($_POST['status'])){
		$food_id = $_POST['food_id'];
		$order_id = $_POST['order_id'];
		$status = $_POST['status'];
		$mysqli->query("UPDATE orderdetails SET order_status='$status' WHERE (food_id='$food_id' AND orderID='$order_id')") or die($mysqli->error);
		header("Location: view_order.php");
 	}
?>

