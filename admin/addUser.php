<?php 
$msg ="";
$alert = false;
require '../_dbConnect.php';
session_start();

if (!$_SESSION['loggedIn']) {

    header("location:_logIn.php");
}
 include './_top.php';

  if(isset($_POST['submit'])){
       $name = $_POST['userName'];
        $contactNumber = $_POST['contactNumber'];
        
        $userEmail = $_POST['userEmail'];


  $checkExist = "SELECT * FROM `user` WHERE `email`= '$userEmail'";
    
    if(mysqli_num_rows(mysqli_query($connection,$checkExist))>0){

     $msg='<strong class="text-danger">Error! User Already Exists!</strong>';
     $alert = true;
    }
 else{


  $Isql= " INSERT INTO `user` (`name`, `mobile`,`email`,`status`) VALUES ('$name', '$contactNumber', '$userEmail','1')";

  $result = mysqli_query($connection,$Isql);
 
  if($result)
  {
    $msg='<strong class="text-success">Success! User Added!</strong>'; 
    $alert = true;


 }



 }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage user</title>
</head>
<body>

<div class="row addcontainer">

<div class="col-md-7">

<?php 
if($alert){
  echo '<div class="alert alert-primary d-inline-block w-100 mx-auto alert-dismissible fade show" role="alert">
  '. $msg .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



    ?>

  <h4 class="display-6 my-3" >Manage User</h4>
 

  <form action="addUser.php" method="post">
  <div class="my-3 ">
    <label for="userName" class="form-label">User Name</label>
    <input type="text" class="form-control" id="userName" name="userName" required aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="contactNumber" class="orderNumberr">Contact Number</label>
    <input type="number" class="form-control" name="contactNumber" id="contactNumber" required>
  </div>
  <div class="mb-3">
    <label for="email" class="email">Email</label>
    <input type="email" class="form-control" name="userEmail" id="userEmail" required>
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Add</button>
</form>

  </div>
</div>
</body>
</html>