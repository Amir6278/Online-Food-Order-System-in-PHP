<?php

   require '../_dbConnect.php';
  

   if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit'])){
    $email = $_POST['email'];
     $pass = $_POST['password'];

     $sql ="SELECT * FROM `admin` WHERE name='$email' AND password = '$pass' ";

     $result= mysqli_query($connection,$sql);
     if( mysqli_num_rows($result) > 0)
     {
      $row = mysqli_fetch_assoc($result);
      session_start();
       $_SESSION['loggedIn'] = 'yes';
       $_SESSION['name'] = $email;
      header("location:index.php");




     }
     else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Invalid Credentials
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
     }

   }



?>







<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login to food</title>
  </head>
  <body>
  
          <div class="mycontainer bg-light">

            <div class="card mycard">
              <img src="admin.png" class="img-fluid shadow-lg" alt="" srcset="">
            <div class="card-body">
              <div class="card-header">
                <h3 class="text-center">Admin LogIn</h3>
               
              </div>
            <form action="_logIn.php" method="POST">
                    <div class="mb-3 ">
                        
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="user">
                        <p class="form-text text-dark">We'll never share your email with anyone else.</p>
                    </div>
                    <div class="mb-3">
                       
                        <input type="password" class="form-control" name="password" id="password"  placeholder="password" required>
                    </div>
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit" >ENTER </button>

                    </div>

                   
                   
                </form>
            </div>
            <div class="card-footer text-center">
            <p class="text-muted text-dark">&copy;LogIn with Valid Credentials</p>
            </div>
            </div>
          </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>