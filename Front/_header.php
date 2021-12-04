<?php
session_start();
 if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
   $log = true;

 } 
 else{
   $log = false;
 }


?>

    <style>
        #cartimg {
            width: 100px;
        }
    </style>
    <!-- modal -->

    <!-- Button trigger modal -->


    <!-- Modal -->
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

    <!-- Modal -->
    <div class="modal fade h-100" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h3 class="modal-title w-50 mx-auto" id="exampleModalLabel"> <i class="fas fa-cart-plus fa-2x"></i> Cart-items </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                    <?php
$carttotal = 0;
if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];

    $oldOrder =   mysqli_query($connection,"SELECT * FROM `order_detail`  WHERE `user_id`= '$userId' AND `order_status` = '0' OR `order_status` = '1' OR  `order_status` = '2'  ");
    $numOrder = mysqli_num_rows($oldOrder);
    if( $numOrder > 0){
       $order =  mysqli_fetch_assoc($oldOrder);
     
       
       echo '<div class="alert alert-dark py-2" role="alert">
       <i class="fas fa-check"></i> You Order Have Been Placed on ' . $order['dt'] . ' <br>
      
          Your Order id is :  <span class="text-danger">'  .$order['order_id']. '</span><br>
          Total Price is : <span class="text-dark">'  .$order['oprice']. ' Tk </span> <br>
          Status : <span class="text-dark">';   if($order['order_status']==0){  echo '<b class="text-info"> Placed </b>';   }  else if($order['order_status']==1) { echo '<b class="text-danger"> Accepted </b>';}  else if($order['order_status']== 2) { echo '<b class="text-danger">   On Deliver  <i class="fas fa-biking"></i> </b>';} echo ' </span> 
         </div>';
        echo ' <div class="text-center"><img src="../chefAvatar.png" class="img-fluid h-50" alt="" srcset=""></div>'.'<br>';
      
       //  $carttotal = $oldOrder['price'];
     
    }
  



else{
   
  
    $selectCart = mysqli_query($connection," SELECT * FROM `cart` INNER JOIN dish_detail ON cart.product_detaill_id = dish_detail.id AND cart.user_id = '$userId' INNER JOIN `dish` ON dish_detail.dish_id = dish.id ");


    $product = mysqli_num_rows($selectCart);
    
   
    if($product>0){
        echo '  <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Dish Name</th>

                <th scope="col">Quantity</th>
                <th scope="col">Sub total</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>';


      while($productRow = mysqli_fetch_assoc($selectCart)){
  
        echo '<tr>
  
        <td scope="row"><img src="../uploads/'.$productRow['image'] .' " class= "img-fluid" id="cartimg" alt="" srcset=""> </td>
        <td>'.$productRow['dish'].'
         <small>--['.$productRow['attribute'].']</small>
           
        </td>
        
        <td>'.$productRow['product_quantity'].'</td>
        <td>'.$productRow['price'] * $productRow['product_quantity'].'</td>
        <td> <a href="home.php?cartDel=' .$productRow['cart_id'].' "> <i class="fas fa-trash-alt fa-2x p-1"></i></a>   </td>';
        $carttotal =  $carttotal  +   ( $productRow['product_quantity'] * $productRow['price']); 
  
      echo '</tr>
      ';
  
  
      }
      

     }
    
    else{
      echo '<div class="alert alert-danger" role="alert">
      <i class="fas fa-exclamation-triangle"></i> Items Not Added Yet!
    </div>';
    }  



}



}
    
    ?>

                        </tbody>



                        </table>

                </div>
                <?php if(isset($product)){
        
        echo '
        <div class="container row d-flex align-items-end">
        <span class="col-9  fw-bold p-2 ">Cart Total : </span>  <span class="col-3  fw-bold p-2 "> '. $carttotal . ' Taka </span>
        
        </div>
        <div class="modal-footer">

        <a type="button" href="checkout.php" target="_blank" class="btn btn-primary w-100 fw-bold text-decoration-none">CheckOut</a>
    </div>';
     
    }
        ?>


              

            </div>
        </div>
    </div>


    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            #cart {
                font-size: 20px;
                font-family: serif;
                line-height: 2px;
                height: 30px;
            }
        </style>
    </head>



    <header>


        <nav class="navbar userMenu navbar-expand-lg navbar-dark bg-dark">

            <div class="container ">
                <a class="navbar-brand" href="home.php"><img src="food.png" class="rounded-circle w-75" alt="" srcset=""> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-0 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="home.php"> <i class="fas fa-store"></i> Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-users"></i> About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="contact.php"><i class="fas fa-envelope-open-text"></i>  Contact Us</a>
                        </li>


                    </ul>

                    <div class="d-flex align-items-end">

                        <?php
     
             if(!$log){

               echo '  <a href="register.php" class="btn btn-outline-success text-light mx-2"><i  class="fas fa-users"></i>  Register</a>
               <a href="login.php" class="btn  btn-outline-success text-light"> <i class="fas fa-user-cog"></i> Log In</a>
                   ';
             }
             else if($log){
               echo ' <li class="nav-item prob fw-bold"><button class="btn  btn-warning mx-3 my-auto"  data-bs-toggle="modal" data-bs-target="#exampleModal" style="height:85%;"> <span id="cart"> <i class="fas fa-cart-plus fa-2x"></i></span></button></li>';
             echo  ' <li class="nav-item dropdown my-1">
               <a class="nav-link dropdown-toggle bg-success rounded" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="fas fa-user"></i>  ' . $_SESSION['name'] .'
               </a>
               <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                 <li><a href="#" class="dropdown-item  mx-2 text-success fw-bold px-3 "> <i class="fas fa-user-tie"></i>  Profile </a> </li>
                    <li><a class="dropdown-item text-success fw-bold mx-2 px-3  " href="signout.php"> <i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
               </ul>
             </li>';
                     

              }
           

             ?>






                    </div>

                </div>


            </div>
        </nav>


    </header>