
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
        


  $checkExist = "SELECT * FROM `delivery_boy` WHERE `mobile`= '$contactNumber'";
    
    if(mysqli_num_rows(mysqli_query($connection,$checkExist))>0){

      $msg='<strong class="text-danger">Error!    Delivery boy Exits</strong>';
     $alert = true;
    }
 else{


  $Isql= " INSERT INTO `delivery_boy` (`name`, `mobile`, `status`) VALUES ('$name', '$contactNumber', '1')";

  $result = mysqli_query($connection,$Isql);
 
  if($result)
  {
     $msg='<strong class="text-success">Sucess!   Delivery boy added Added!</strong>'; 
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
  <title>Add Delivery Man</title>
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
        <h4 class="display-6 my-3" >Add Delivery Boy</h4>
  <form action="addDeliveryBoy.php" method="post">
  <div class="my-3 ">
    <label for="userName" class="form-label">Delivery Boy Name</label>
    <input type="text" class="form-control" id="userName" name="userName" required aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="contactNumber" class="orderNumberr">Contact Number</label>
    <input type="number" class="form-control" name="contactNumber" id="contactNumber" required>
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Add</button>
</form>



  </div>

</div>





</body>
</html>
  

