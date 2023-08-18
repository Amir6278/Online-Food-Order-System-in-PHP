




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontWesomeCDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Shop</title>
</head>

<body>

  






    <?php 
 
  require_once('../_dbConnect.php');
   require_once('_header.php');


//  checkboxValue handle
 $cat_dis="";
  $cat_dis_Arr=array();
 if(isset($_GET['cat_dis']))
 {
$cat_dis=   $_GET['cat_dis'];


$cat_dis_Arr = array_filter(explode(':',$cat_dis));

$cat_dis_str = implode(',',$cat_dis_Arr);

// print_r($cat_dis_str);



}


    //   Add to Cart
    if(isset($_POST['addcart']) && $_POST['addcart'] == "added"){

        if(isset($_SESSION['loggedIn']))
        {
            // echo '
            // <script type="text/javascript">
            
            // alert("Good job!", "Iem added to cart");
            
            // </script>
            // ';
         $productDetailID = $_POST['productdetail']; 
            $productquantity = $_POST['quantity'];
        $userid= $_SESSION['userId'];

           $checkCart = mysqli_query($connection,"SELECT * FROM `cart` WHERE `product_detaill_id` = '$productDetailID' AND `user_id` = '$userid=' ");
             
              $existdish = mysqli_num_rows($checkCart);
              if($existdish){

                
                $updatecart= mysqli_query($connection,"UPDATE `cart` SET `product_quantity`='$productquantity' WHERE `product_detaill_id` = '$productDetailID' AND `user_id` = '$userid' ");
                echo '<script>window.location = `home.php`</script>';
              }

              else{
                $cartInsert= "INSERT INTO `cart`(`user_id`, `product_detaill_id`, `product_quantity`) VALUES ('$userid','$productDetailID','$productquantity')";

                $cartInsertResult = mysqli_query($connection,$cartInsert);
   
   
                if( $cartInsertResult){
                    // echo 'ok';
                    echo '<script>window.location = `home.php`</script>';
                }
              }
           
        }
        else{
    
              echo '<div style="z-index:5;"class="alert alert-danger alert-dismissible fade show py-4 mb-0" role="alert">
             <strong><i class="fas fa-exclamation-triangle"></i> Oops!</strong> Please Log In  Before adding dish to your cart!  <i class="fas fa-undo-alt"></i> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';

    
    
    }
    
    
    }
    


 
    if(isset($_GET['cartDel'])){
        $cartDel = $_GET['cartDel'];
        
$cartDelQuery= mysqli_query($connection," DELETE FROM `cart` WHERE `cart_id` =  ' $cartDel' ");
        
echo '<script type="text/javascript"> window.location="home.php";</script>';

        
    }



 ?>
  



<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded shadow-lg">
      <div class="modal-header text-light w-100 bg-secondary ">
        <h5 class="modal-title" id="couponModalLabel"> APPLY COUPON FOR    <i class="fas fa-percent"></i>  DISCOUNT</h5>
        <button type="button" class="btn-close"  class="bg-warning" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light">
          
   <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#Coupon Code </th>
      <th scope="col">Cart Minimum Value* </th>
      
    </tr>
  </thead>
   
  <tbody>
      
  <?php

$couponSelect = mysqli_query($connection,"SELECT * FROM `coupon_code` WHERE `status` = '1' ");

while($couponRow = mysqli_fetch_assoc($couponSelect)){
        
echo '<tr>
      
     
<td>'. $couponRow['coupon_code'] .'</td>
<td>'. $couponRow['cart_min_value'] .'Tk/</td>
</tr>';
}



?>

    
    
  </tbody>
</table>

      </div>
      <p class="text-muted fw-bold px-2"> &copy; make sure to have minimum cart value to use coupon</p>
    </div>
  </div>
</div>



    <!-- Banner/Coupon-code-->


  

    <div class="row">
        <div class="col-12">
            <div class="coupon-banner shadow-lg fw-bolder">

                <div class="container pt-5 text-center">

                    <h4 class="card-text"> APPLY COUPON AND GET EXCLUSIVE DISCOUNT!</h4>

                    <a href="#" type="button" class="btn mt-3 fw-bold btn-outline-warning "  data-bs-toggle="modal" data-bs-target="#couponModal">VIEW COUPON</a>


                </div>



            </div>


        </div>


    </div>




      <!-- Category name from database -->

  


    <div class="row">



        <div class="col-md-3 d-flex align-items-start justify-content-center mt-5">


        
            <ul class="list-group w-100 text-center">
                <div class="card-header"><h3 class=" lead text-center fw-bolder"><i class="fas fa-list mx-2"></i>Shop By Category</h3></div>

    <a class=" fw-bold text-danger w-50 mx-auto my-2 text-decoration-none bg-light border border-dark p-1 rounded mb-2" href="home.php">Clear All <i class="fas fa-undo"></i></a>
  <?php
   
  
   $categorytable ="SELECT * FROM `category` WHERE `status`=1";

   $categoryTableResult = mysqli_query($connection,$categorytable);

  while($row = mysqli_fetch_assoc($categoryTableResult)){
    $is_checked="";
    if(in_array($row['id'],$cat_dis_Arr)){
        $is_checked = 'checked';
    }
  
    echo ' <li class="list-group-item w-100 py-2 px-auto text-start"> <input class="d-inline mx-2" id="cat_list_id"  onclick=setCheckBox("'.$row['id'].'")   '. $is_checked .'  type="checkbox" name="category_id[]" value=' .$row['id'] . ' id=""> ' . $row["category"] .'
     </li>';
 }


?>

       </ul>

        </div>




        <!-- dispaly dish -->

  

        <div class=" container col-md-9 h-50 bg-light">

            <div class="row">
          
                   <!-- product items -->

            <?php
        
        $product_dish_id ="";
              $product_sql = "SELECT * FROM `dish` WHERE `status`= '1' ";
              
   if(isset($_GET['cat_dis']) && $_GET['cat_dis']!=''){
       
    $product_sql  .= "and `category_id` in ($cat_dis_str) ";

   }

      $product_resouce = mysqli_query($connection,$product_sql);

    //    print_r( $product_resouce);

            if(mysqli_num_rows($product_resouce)>0){
              
             while($product_row = mysqli_fetch_assoc($product_resouce)){

                $product_dish_id =  $product_row['id'] ;
                 $detailSQL= mysqli_query($connection,"SELECT * FROM `dish_detail` WHERE `dish_id` = '$product_dish_id ' ");
         
                  
                 echo '  <div class="col-md-4 p-5 ">
                 <div class="card mycard rounded p-2" style="max-width: 100%;">
                     <img src="../uploads/'. $product_row['image'].'" class="card-img-top img-fluid h-100" alt="...">
                     <div class="card-body text-center h-50">
                         <h6 class="card-title">'. $product_row['dish'].'</h6>
                         <p class="text-muted">'. $product_row['dish_detail'].'</p>';
                            
                         while($detail = mysqli_fetch_assoc($detailSQL)){

                             

                            echo '    <form method="POST" action="home.php">



                          <input type="radio" class="text-start dam" name="productdetail" required id="" value=" '. $detail['id'] .'"> '. $detail['attribute'] .'  <i> --' . $detail['price'] .'&#2547;  </i> <br>' ;


                           
                         }

                      
                         
                       echo   '</div>
                      <div class="card-footer">
                        <div class="row mb-2"><input type="number" class="form-control w-25 px-2" id="quantity" name="quantity" required placeholder="1" min="1" max="20" value=""> 
                        
                        <button type="submit" class="btn btn-primary w-75 fw-bold mb-1 " id="addcart" name="addcart" value="added"> <i class="fas fa-cart-plus"></i> Add to Cart</button></div>

                          </form>
                        <div class="row"><a href= " productdetail.php/?productId='. $product_dish_id . '" class="btn btn-outline-info w-100 text-dark fw-bold"  target="_blank"  >View dish</a></div>
                     </div>
                 </div> </div>';
          
          
          
          
          
          
          
              }

           

          }

   else{
     echo '<div class="alert alert-danger my-5  w-100  mx-auto role="alert"><i class="fas fa-ban fa-2x mx-1"></i>   <strong>Sorry!</sorry> No dish found! </div>';

    }


?>

 </div>

        </div>
    </div>
 <form action="home.php" method="GET" id="checkForm" style="visibility:hidden;">
 
 <input type="text" name="cat_dis" id="checkboxValue" value="<?= $cat_dis; ?>">
 
 <input type="submit"  name="check_submit" value="submit">
  </form>  

    <!-- pagination -->
<!--    <div class="container d-flex justify-content-center">
   <div class="text-center">
        <nav aria-label="Page navigation text-center example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
   </div>
 -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
 
<script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
        <script src="main.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
         
   function setCheckBox(id) {
      
         var cat_value =  $("#checkboxValue").val();
         var check= cat_value.search(":"+ id)
         if(check!='-1'){
            cat_value = cat_value.replace(":"+ id,''); 
         }
         else{
            cat_value = cat_value + ":" + id; 
         }
         
          
         $("#checkboxValue").val(cat_value);
         console.log(cat_value)
          $("#checkForm")[0].submit();
          
       
    }

 document.getElementById('addcart').addEventListener('click',(e)=>{
     if(document.getElementById('quantity').value != ''){
       
     }
    
 })

 </script>
      





    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

<?php 

require_once('_footer.php');

?>

</html>
