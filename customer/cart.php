<?php
	include("nav.php"); 
	include('../dbh/dbh.php'); 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cart</title>
    <style>
    	body{
        background: linear-gradient(to bottom, #003399 10%, #ffcccc 110%);
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
    </style>
  </head>
  <body>
  	<?php
		if (isset($_POST['cart'])){
			if (isset($_SESSION['food_cart'])){
				$food_array_id = array_column($_SESSION['food_cart'], 'food_id');
				if (!in_array($_POST['food_id'], $food_array_id) && $_POST['availability'] == 'yes'){
					$count = count($_SESSION['food_cart']);
					$food_array = array(
						'food_id' => $_POST['food_id'],
						'name' => $_POST['food_name'],
						'price' => $_POST['price'],
						'qty' => $_POST['qty'],
						'shop_name' => $_POST['shop_name']
					);
					$_SESSION['food_cart'][$count] = $food_array;
					header("Location: menu.php");
					$_SESSION['message'] = $_POST['food_name'].' '.'added to cart!';
					$_SESSION['alert'] = 'success';
				}
				else if ($_POST['availability'] == 'no'){
					$_SESSION['message'] = $_POST['food_name'].' '.'is currently not available!';
					$_SESSION['alert'] = 'danger';
					header("Location: menu.php");
				}
				else {
					$_SESSION['message'] = $_POST['food_name'].' '.'already added to cart!';
					$_SESSION['alert'] = 'danger';
					header("Location: menu.php");
				}
			}
			else {
				$food_array = array(
					'food_id' => $_POST['food_id'],
					'name' => $_POST['food_name'],
					'price' => $_POST['price'],
					'qty' => $_POST['qty'],
					'shop_name' => $_POST['shop_name']
				);
				$_SESSION['food_cart'][0] = $food_array;
				header("Location: menu.php");
				$_SESSION['message'] = $_POST['food_name'].' '.'added to cart!';
				$_SESSION['alert'] = 'success';
			}
		}
		if (isset($_GET['action'])){
			if ($_GET['action'] == 'delete'){
				foreach ($_SESSION['food_cart'] as $key => $value) {
					if ($value['food_id'] == $_GET['id']){
						unset($_SESSION['food_cart'][$key]);
						echo '<script>alert("Item removed!")</script>';
						echo '<script>window.location="cart.php"</script>';
					}
				}
			}
		}
	?>
	<div class="container">
		<div class="row">
			<table class="table" style="margin-top: 30px;">
    			<?php
    				if (!empty($_SESSION['food_cart'])){
    					$total = 0; ?>
	    				<thead>
				            <tr>
				              <th style="text-align: center; border-top: 2px solid #FDFEFE; border-bottom: 2px solid #FDFEFE;">Food</th>
				              <th style="text-align: center; border-top: 2px solid #FDFEFE; border-bottom: 2px solid #FDFEFE;">Shop Name</th>
				              <th style="text-align: center; border-top: 2px solid #FDFEFE; border-bottom: 2px solid #FDFEFE;">Price</th>
				              <th style="text-align: center; border-top: 2px solid #FDFEFE; border-bottom: 2px solid #FDFEFE;">Quantity</th>
				              	<th style="text-align: center; border-top: 2px solid #FDFEFE; border-bottom: 2px solid #FDFEFE;">Total</th>
				              <th style="text-align: center; border-top: 2px solid #FDFEFE; border-bottom: 2px solid #FDFEFE;">Action</th>
				            </tr>
			    		</thead>
    					<?php
    					foreach ($_SESSION['food_cart'] as $key => $value) {?>
			    			<tr style="border-bottom: 1px solid #FDFEFE;">
			  					<td style="text-align: center;"><b><?php echo $value['name'];?></b></td>
			  					<td style="text-align: center;"><b><?php echo $value['shop_name'];?></b></td>
			  					<td style="text-align: center;"><b><?php echo $value['price'];?></b></td>
			                    <td style="text-align: center;"><b><?php echo $value['qty'];?></b></td>
			                    <td style="text-align: center;"><b><?php echo $value['qty'] * $value['price'];?></b></td>
			                    <td style="text-align: center;"><a href="cart.php?action=delete&id=<?php echo $value['food_id'];?>" style="text-decoration: none;">&#10060;</a></td>
			                </tr>
			                <?php
			                	$total = $total + ($value['qty'] * $value['price']);
			            }?> 
		                	<td colspan="4" style="text-align: right;"><b>Total:</b></td>
		                	<td style="text-align: center"><b>THB. <?php echo $total;?></b></td>
                	<?php }?>
			</table>
			<?php
				if (!empty($_SESSION['food_cart'])){?>
					<div class="row" style="margin-left: 800px;">
						<form action="cart.php" method="post">
							<button type="submit" class="btn btn-success" name="checkout" style="border-radius: 15px;">Confirm Payment</button>
						</form>
					</div>
				<?php }?>
			<?php
				if (empty($_SESSION['food_cart'])){?>
					<div style="margin-top: 100px; margin-left: 290px;">
						<h1 style="color: white;">Your cart is empty!</h1>
						<a href="menu.php" style="font-size: 20px; color: green; text-decoration: underline; margin-left: 140px;">Add items</a>
					</div>
				<?php }?>
		</div>
	</div>
	<?php
		if (isset($_POST['checkout'])){
			$id = $_SESSION['id'];
			$balance = $_SESSION['cus_balance'];
			$date = date("Y-m-d");
			date_default_timezone_set("America/New_York");
			$time = date("h:i:s");
			if ($balance >= $total){
				$mysqli->query("INSERT INTO orders (order_date, order_time, total, cus_id) VALUES('$date', '$time', '$total', $id)") or die($mysqli->error);
				$order_id = $mysqli->insert_id;
				foreach ($_SESSION['food_cart'] as $key => $value) {
					$qty = $value['qty'];
					$order_status = 'preparing';
					$food_id = $value['food_id'];
					$mysqli->query("INSERT INTO orderdetails (quantity, order_status, orderID, food_id) VALUES('$qty', '$order_status', '$order_id', '$food_id')") or die($mysqli->error);
				}
				$mysqli->query("UPDATE customer SET cus_balance=$balance-$total WHERE cus_id='$id'") or die($mysqli->error);
				unset($_SESSION['food_cart']);
				echo '<script>alert("Order placed successfully!")</script>';
				echo '<script>window.location="cart.php"</script>';
			}
			else {
				echo '<script>alert("You do not have enough balance!")</script>';
				echo '<script>window.location="cart.php"</script>';
			}
		}
	?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>