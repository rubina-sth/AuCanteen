<?php
session_start();
include("../dbh/dbh.php");
$id = $_SESSION['cashier_id'];
$result = $mysqli->query("SELECT * FROM cashier WHERE cashier_id='$id'") or die($mysqli->error);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cashier Home</title>
    <style>
      body{
        background-image: url(../customer/css/images/cashB.jpg);
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }

      .btn:hover{
        opacity: 0.9;
      }
    </style>
  </head>
  <body>
    <?php
      if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['alert']?> alert-dismissable text-center">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
        </div>
      <?php endif ?>

    <?php while ($row = $result->fetch_assoc()){?>
      <h4 style="color: white;">Cashier ID: <?php echo $row['cashier_id'];?></h1>
    <?php }?>
    <div>
      <form action="cashier_loginPHP.php" method="post">
        <button type="submit" class="btn btn-danger" name="cashier_logout" style="float: right; margin-right: 8px; margin-top: -20px;">Logout</button>
      </form>
    </div>
    <div class="text-center" style="margin-top: 80px;">
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#add_balance" style="background-color: #FFBA5C; margin-left: 30px; border-style: none; width: 250px; height: 45px; border-radius: 15px; margin-top: 150px;"><b>Add Balance</b></button><br>
    </div>

    <div class="modal" id="add_balance">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Balance</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form action="CRUDquery.php" method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label for="id">ID:</label>
                  <input type="text" class="form-control" id="id" placeholder="Enter id" name="id">
                </div>
                <div class="form-group">
                  <label for="balance">Balance:</label>
                  <input type="number" class="form-control" id="balance" placeholder="Enter balance" name="balance">
                </div>
                <div class="form-group">
                  <label for="confirmBalance">Confirm Balance:</label>
                  <input type="number" class="form-control" id="confirmBalance" placeholder="Confirm balance" name="confirmBalance">
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" name="addBalance">Confirm</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal" id="withdraw_amount">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Withdrawl</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form action="/action_page.php" method="post">
            <div class="modal-body">
                <div class="form-group">
                  <label for="id">ID:</label>
                  <input type="email" class="form-control" id="id" placeholder="Enter id" name="id">
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="withdraw">Proceed</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>