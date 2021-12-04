<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <title>ORDER</title>
</head>

<body>
    <?php
require_once('../_dbConnect.php');
$icount=0;
require_once('_header.php');
if(isset($_POST['placeOrder'])){
      $orderId = uniqid('food');


  $userId = $_SESSION['userId'];
  $price =  $_POST['price'];
  $cartSelect = mysqli_query($connection,"SELECT * FROM `cart` WHERE `user_id` = '$userId' ");
 
       while($cartData = mysqli_fetch_assoc($cartSelect)){
           $productDid = $cartData['product_detaill_id'];
           $userid= $cartData['user_id'];   
            $productQuantity = $cartData['product_quantity'];

             $orderDetailInsert = mysqli_query($connection,"INSERT INTO `order_detail`(`order_id`,`user_id`, `dish_detail_id`, `quantity`, `oprice`,`order_status`) VALUES ('$orderId','$userid','$productDid','$productQuantity','$price','0') ");





          if($orderDetailInsert){
              $icount++;
          }
       
       }
     

   if($icount>0){
    echo '
       <div class="alert alert-primary" role="alert">
       <h4 class="alert-heading">Success! </h4>
       <p>Your order has been Placed Successfully.
       Check Your Cart for Further Updates!</p>
       <hr>
       <p class="mb-0">.</p>
     </div> 
     
   <div class="text-center my-3">  <a type="button" href="home.php" class="btn btn-primary btn-lg  w-50 mx-auto fw-bold text-decoration-none"><i class="fas fa-utensils"></i> <i class="fas fa-arrow-left"></i>       Back to Shop </a></div>
     ';
       

      

   }






}











?>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>