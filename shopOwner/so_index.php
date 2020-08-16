<?php
  session_start();
  include("../dbh/dbh.php");
  $id = $_SESSION['shop_id'];
  $result = $mysqli->query("SELECT * FROM shopowner NATURAL JOIN shop WHERE so_id='$id'") or die($mysqli->error);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Shop Owner Home</title>
    <style>
      body{
        background-image: url(../customer/css/images/Sback.jpg);
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
      .col-8{
        background-color: rgba(255,255,255,0.4);
        height: 420px;
        margin-top: 90px;
        border-radius: 20px;
        box-shadow: 0px 0px 30px 20px;
      }

      .btn:hover{
        opacity: 0.9;
      }
    </style>
  </head>
  <body>
    <?php while ($row = $result->fetch_assoc()){?>
      <h4 style="color: white;">Shop Name: <?php echo $row['shop_name'];?></h4>
    <?php }?>
    <div>
      <form action="so_loginPHP.php" method="post">
        <button type="submit" class="btn btn-danger" name="so_logout" style="float: right; margin-right: 8px; margin-top: 8px;">Logout</button>
      </form>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <div class="text-center">
            <a href="view_order.php"><button class="btn btn-warning" style="background-color: #FFBA5C; border-style: none; width: 150px; height: 45px; margin-top: 120px;">View Order</button></a><br>
            <a href="modify_menu.php"><button class="btn btn-warning" style="background-color: #FFBA5C; border-style: none; width: 150px; height: 45px; margin-top: 50px;">Modify Menu</button></a>
          </div>
        </div>
        <div class="col-2"></div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>