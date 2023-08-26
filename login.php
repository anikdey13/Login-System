<?php 

$login = false;
$showErr = false;


if($_SERVER["REQUEST_METHOD"] == "POST"){

  include("partial/_dbconnect.php");

  $username = $_POST['username'];
  $password = $_POST['password'];
 
/*
  $sql = "SELECT * FROM `users` WHERE username == '$username'";
  $result = mysqli_query($conn, $sql);
  if($result){

    echo 'Username not avaiable try anotherone';
    $exits = true;

  }elseif($password == $cpassword){

    $sql = "INSERT INTO `users` (`username`, `password`,`dt`) VALUES ('$username', '$password',current_timestamp())";
    $result = mysqli_query($conn,$sql);

    if($result){
      $showAlert = true;
    }else{
      echo 'Record insertion falied';
    }
  }else{
    $showErr = "Password do not match";
  }

*/
  

    // $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn,$sql); 
    $num = mysqli_num_rows($result);

    if($num == 1){
      while($row = mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['password'])){

          $login = true;

          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          header("location: welcome.php");

        }else{
          $showErr = "Incorrect username or password! Please try again.";
        }
      }
      
    }else{
      $showErr = "Incorrect username or password! Please try again.";
    }

  }


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php require("partial/_nav.php"); ?>

    <?php 
      if($login){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if($showErr){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Opps!</strong> '.$showErr.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    ?>

    <div class="container mt-3">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <h1 class="text-center">Sign In</h1>
          <form action="/loginsystem/login.php" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>

        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>