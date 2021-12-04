<?php
$msg ="";
$alert = false;

require '../_dbConnect.php';
session_start();

if (!$_SESSION['loggedIn']) {

    header("location:_logIn.php");
}
include './_top.php';

if (isset($_POST['submit'])) {
  $name = $_POST['categoryName'];
  $orderNum = $_POST['orderNumber'];



  $checkExist = "SELECT * FROM `category` WHERE `category`= '$name'";

  if (mysqli_num_rows(mysqli_query($connection, $checkExist)) > 0) {

    $msg='<strong class="text-danger">Error! Item Already Exist!</strong>';
    $alert = true;
  } 
  else
   {

    $Isql = " INSERT INTO `category` (`category`, `order_num`, `status`) VALUES ('$name', '$orderNum', '1')";

    $result = mysqli_query($connection, $Isql);

    if ($result) {
      $msg='<strong class="text-success">Success! Item Added!</strong>'; 
    $alert = true;
    }
  }
}


?>

<div class="row addcontainer">

<div class="col-md-7">




<?php 
if($alert){
  echo '<div class="alert alert-warning d-inline-block w-100 mx-auto alert-dismissible fade show" role="alert">
  '. $msg .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



    ?>
  <h4 class="display-6 my-3">Add a Category</h4>
  <form action="addCategory.php" method="post">
    <div class="my-3">
      <label for="categoryName" class="form-label">Category Name</label>
      <input type="text" class="form-control" id="categoryName" name=categoryName required aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="orderNumber" class="orderNumberr">Order Number</label>
      <input type="number" class="form-control" name="orderNumber" id="orderNumber" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Add</button>
  </form>

</div>
</div>