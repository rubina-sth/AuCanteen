<?php  
	include("nav.php");
  include('../dbh/dbh.php');
  $id = $_SESSION['id'];
  $order = $mysqli->query("SELECT DISTINCT(orderID), (order_time+INTERVAL 10 MINUTE) AS orderTime, order_date, order_status FROM orders NATURAL JOIN orderdetails WHERE cus_id='$id'") or die($mysqli->error);
  $result = $mysqli->query("SELECT orderID, order_date, total, quantity, order_status, food_id FROM orders NATURAL JOIN orderdetails WHERE cus_id='$id'") or die($mysqli->error);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Track Food</title>
    <style>
      body{
        background: linear-gradient(to bottom right, #00ffff 0%, #003366 100%);
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
    </style>
  </head>
  <body>
  	<div class="text-center">
      <?php $count = 0;?>
      <?php while($row = $order->fetch_assoc()):?>
        <?php $date = date("Y-m-d");?>
        <?php if ($row['order_date'] == $date && $row['order_status'] != 'pickedup'):?>
          <?php if (0 == $count++):?>
        		<span class="badge badge-success" style="margin-top: 50px; width: 120px; height: 30px; border-radius: 30px; padding-top: 8px; background-color: #6D5C4F;">Order # <?php echo $row['orderID'];?></span>
        		<p style="color: green; margin-top: 20px;"><b>Estimated Pickup Time: <?php echo $row['orderTime']?></b></p>
          <?php endif;?>
        <?php endif;?>
      <?php endwhile;?>
  	</div>
  	<div class="container">
  		<div class="row" style="margin-top: 50px;">
        <table class="table">
          <thead>
            <tr style="border-top: 2px solid white;">
              <th style="text-align: center;">Items</th>
              <th style="text-align: center;">Quantity</th>
              <th style="text-align: center;">Shop Name</th>
              <th style="text-align: center;">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php while($row = $result->fetch_assoc()):?>
            <?php $food_id = $row['food_id'];?>
            <?php $food_name = $mysqli->query("SELECT * FROM food WHERE food_id='$food_id'") or die($mysqli->error);?>
            <?php $shop_name = $mysqli->query("SELECT * FROM food NATURAL JOIN shop WHERE food_id='$food_id'")?>
            <?php if ($row['order_date'] == $date && $row['order_status'] != 'pickedup'):?>
              <tr>
                <td style="text-align: center;"><b><?php while($row1 = $food_name->fetch_assoc()){ echo $row1['food_name'];}?></b></td>
                <td style="text-align: center;"><b><?php echo $row['quantity'];?></b></td>
                <td style="text-align: center;"><b><?php while($row2 = $shop_name->fetch_assoc()){ echo $row2['shop_name'];}?></b></td>
                <td style="text-align: center;"><b><?php echo $row['order_status'];?></b></td>
              </tr>
            <?php endif;?>
          <?php endwhile;?>
          </tbody>
        </table>
  		</div>  
  	</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>