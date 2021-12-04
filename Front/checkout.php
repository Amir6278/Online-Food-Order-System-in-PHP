<?php

require_once('../_dbConnect.php');

require_once('_header.php');
$discount=0;
if(!$_SESSION['loggedIn']){
  echo '<script type="text/javascript"> window.location="home.php";</script>';

} else{

  if(isset($_POST['csubmit'])){

    $coupon = $_POST['coupon'];
    $checkCoupon = mysqli_query($connection,"SELECT * FROM `coupon_code` WHERE `coupon_code` = '$coupon' ");
   if(mysqli_num_rows($checkCoupon) > 0){
     
  
     
      while($couponRow = mysqli_fetch_assoc($checkCoupon)){
  
        $discount = $couponRow['cart_min_value'];
        //  print_r($couponRow);
      }
  
  
   }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong><i class="fas fa-exclamation-triangle mx-2"></i>  Error!</strong> Invalid Coupon
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   
  
  }
  
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Font Awesome CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" href="style.css">
        <title>Checkout</title>
        <style>
            .prob {
                margin-top: 1.2rem;
            }
        </style>
    </head>


   


        <body>



            <div class="container py-3 border border-gray border-2 shadow-lg my-2">


                
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="">Image</th>
                                <th scope="col">Dish Name</th>

                                <th scope="col">Dish Detail</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Sub Total</th>
                            </tr>
                        </thead>
                        <?php

$userId = $_SESSION['userId'];


       $selectCart = mysqli_query($connection," SELECT * FROM `cart` INNER JOIN dish_detail ON cart.product_detaill_id = dish_detail.id AND cart.user_id = '$userId' INNER JOIN `dish` ON dish_detail.dish_id = dish.id ");


  $product = mysqli_num_rows($selectCart);
  $carttotal = 0;
  if($product>0){
    while($productRow = mysqli_fetch_assoc($selectCart)){

      //print_r($productRow);
      $pDetailID = $productRow['product_detaill_id'];
    
      $quantity = $productRow['product_quantity'];
      
    echo ' <tbody>
    <tr>
    

      <td> <img src="../uploads/'.$productRow['image'] .' " class= "img-fluid" id="cartimg" alt="" srcset=""></td>
      <td>'.$productRow['dish'] .'</td>
           
      <td>'.$productRow['attribute'] .'</td>
      <td>'.$productRow['product_quantity'] .'</td>
      <td>'. $productRow['price'] * $productRow['product_quantity'].'</td>';
      $carttotal = $carttotal +   ($productRow['price'] * $productRow['product_quantity']);
   echo ' </tr>';  
 


    }

    echo ' </tbody>
    </table> 

    <div class="container row ">
    <span class="col-4 my-2">  
      <form action="checkout.php" method="POST">
      <input type="text" class="form-control-sm fw-bolder px-3 my-3" name="coupon" placeholder="ADD COUPON CODE" required> 
      <input type="submit" class="btn btn-outline-primary fw-bold " name="csubmit" value="APPLY">
    </form> </span> 
    <div class="col-3"></div>
    <span class="col-md-5 fw-bold px-2" style="border-left: 2px solid #ddd;">
       <div class="col-12 text-end">
        Delivery Charge  : + 50
       </div>
   <div class="row">
    <div class="col-12 text-end">
      <span class="fw-bold"> Discount : '; if($carttotal >= $discount){ echo  '-  '. $discount ;} else {echo '<small class="text-danger px-1"> Minimun Cart value doesn`t reach </small>';} echo ' </span>
    </div>
   </div>

 <div class="row">
   <div class="col-12 text-end">
    <span class="fw-bold mt-2"> Total : ';if($carttotal >= $discount){echo   $total = $carttotal - $discount + 50; }else {echo $total=  $carttotal  + 50;}  echo ' Tk  </span>
   
   </div>
 </div>

    </span>
    
    </div> 
    <form action="order.php" method="post">
    <input type="hidden" name="price" value="'.$total.'">
    <div class="row mt-4">
      <div class="col-12">
      
        <button type="submit" name="placeOrder" class="btn btn-primary w-100 my-3 fw-bold p-2 ">PLACE ORDER</button>
      </div>
    </div>

    </form>
   


  
   
    
  
    
    ';

  }
  else{
    echo '<div class="alert alert-danger" role="alert">
    <i class="fas fa-exclamation-triangle"></i> Items Not Added Yet!
  </div>';
  }  

    ?>
               
            </div>
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