<?php
  session_start();
  include('../dbh/dbh.php');
  // if isset($_SESSION['id']){
    $id = $_SESSION['id'];
    $result = $mysqli->query("SELECT * FROM customer WHERE cus_id='$id'") or die($mysqli->error);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

  <body>
    <?php while ($row = $result->fetch_assoc()){?>
      <nav class="navbar navbar-expand-md bg-warning navbar-dark">
        <div class="navbar-brand">
          <img src="css/images/logo.png" style="width:50px; margin-left: 25px">
          <p style="font-family: 'Berkshire Swash', cursive; color: #5A6978; font-size: 20px;">Au Canteen</p>
        </div>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="cus_index.php" style="color: white; font-size: 18px; margin-top: 60px; margin-left: 100px;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php" style="color: white; font-size: 18px; margin-top: 60px; margin-left: 100px;">Food Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="track.php" style="color: white; font-size: 18px; margin-top: 60px; margin-left: 100px;">Track Order</a>
            </li>
          </ul>
        </div>
        <div class="row">
          <p style="color: white; margin-left: 200px; margin-bottom: 80px; font-size: 18px;">Balance: <?php echo $row['cus_balance'];?></p>
          <?php $_SESSION['cus_balance'] = $row['cus_balance'];?>
        </div>
        <div class="row" style="margin-top: 70px;">
          <p style="color: red; font-size: 12px;"><b><?php if (isset($_SESSION['food_cart'])){ echo count($_SESSION['food_cart']);}else{echo 0;}?></b></p>
          <a href="cart.php" style="margin-right: 30px;"><img src="css/images/cart.png" style="width: 40px;"></a>
          <form action="cus_loginPHP.php" method="post">
            <button type="submit" class="btn btn-danger" name="cus_logout" style="padding: 4px 10px; border-radius: 8px;">Logout</button>
          </form>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
    <?php }?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <!--  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  </body>
</html>