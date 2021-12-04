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
  $couponName = $_POST['couponName']; 
  $couponType = $_POST['couponType'];
  $cartMinValue = $_POST['cartMinValue'];
  $expiredOn = $_POST['expiredOn'];



  $checkExist = "SELECT * FROM `coupon_code` WHERE `coupon_code`= '$couponName'";

  if (mysqli_num_rows(mysqli_query($connection, $checkExist)) > 0) {

    $msg='<strong class="text-danger">Error! Coupon Already Exist!</strong>';
    $alert = true;
  } 
  else              
   {

    $Isql = " INSERT INTO `coupon_code` (`coupon_code`, `coupon_type`, `cart_min_value`,`expired_on`,`status`) VALUES ('$couponName', '$couponType', '$cartMinValue','$expiredOn','1')";

    $result = mysqli_query($connection, $Isql);

    if ($result) {
      $msg='<strong class="text-success">Success! Coupon  Added!</strong>'; 
    $alert = true;
    }
  }
}


?>

<div class="row addcontainer">

<div class="col-md-7">
<?php 
if($alert){
  echo '<div class="alert alert-warning d-inline-block w-100 mx-auto alert-dismissible fade show " role="alert">
  '. $msg .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



    ?>
  <h4 class="display-6 my-3">Add a Coupon</h4>
  <form action="addcoupon.php" method="post">
    <div class="my-3">
      <label for="categoryName" class="form-label">Coupon code</label>
      <input type="text" class="form-control" id="categoryName" name="couponName" required aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="couponType" class="orderNumberr">Coupon type</label>
      <input type="text" class="form-control" name="couponType" id="orderNumber" required>
    </div>
    <div class="mb-3">
      <label for="cartMinValue" class="orderNumberr">Cart minimun value</label>
      <input type="number" class="form-control" name="cartMinValue" id="cartMinValue" required>
    </div>
    <div class="mb-3">
      <label for="expiredOn" class="orderNumberr">Expired On</label>
      <input type="date" class="form-control" name="expiredOn" id="expiredOn" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Add Coupon</button>
  </form>

</div>
</div>