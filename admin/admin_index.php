<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Admin Home</title>
    <style>
      body{
        background-image: url(../customer/css/images/back.jpg);
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
    <div>
      <form action="admin_loginPHP.php" method="post">
        <button type="submit" class="btn btn-danger" name="admin_logout" style="float: right; margin-right: 8px; margin-top: -20px;">Logout</button>
      </form>
    </div>
    <div class="text-center" style="margin-top: 50px;">
      <a href="so_createAccount.php"><button class="btn btn-warning" style="background-color: #FFBA5C; margin-left: 70px; border-style: none; width: 150px; width: 250px; height: 45px; margin-top: 180px;">Create Shop Owner Account</button></a><br>
      <a href="cashier_createAccount.php"><button class="btn btn-warning" style="background-color: #FFBA5C; border-style: none; width: 150px; width: 250px; height: 45px; margin-top: 50px;">Create Cashier Account</button></a><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>