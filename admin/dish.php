<?php
$msg ="";
$alert = false;
require '../_dbConnect.php';
session_start();
$page=="dish";
if (!$_SESSION['loggedIn']) {

    header("location:_logIn.php");
}

 include './_top.php';


  if((isset($_GET['Id']))  && isset($_GET['type']))

  {

     if($_GET['type'] == 'delete')
     {

       $Id = $_GET['Id'];
        
        $Dsql = "DELETE FROM `dish` WHERE id= $Id";
      $result=mysqli_query($connection,$Dsql);

      echo '<script type="text/javascript"> window.location="dish.php";</script>';
     
    }

    if($_GET['type'] == 'active' || $_GET['type'] == 'deactive')

    {
        $status=1;
        $Id = $_GET['Id'];
       
         if($_GET['type'] == 'deactive')
         {
            $status=0;
         }
            
         $Usql = " UPDATE `dish` SET `status`='$status' WHERE `id` = $Id";
         $result =mysqli_query($connection,$Usql);
         echo '<script type="text/javascript"> window.location="dish.php";</script>';
        //  header("location:dish.php");
      
      
    }



  }
  // <!-- editing dish script  -->

  if(isset($_POST['sno'])){

  $editDishName = $_POST['editDishName'];
   $editcatNum =  $_POST['editcatNum'];
    $sno = $_POST['sno'];
    $dishImage = $_FILES['editdishImage'];
    // echo "<pre>";
    //     print_r($_FILES['editdishImage']);
    //    echo "</pre>";
    $dishImageName = $_FILES['editdishImage']['name'];
    $dishImageType = $_FILES['editdishImage']['type'];
    $dishImageTmpName = $_FILES['editdishImage']['tmp_name'];
    $dishImageError = $_FILES['editdishImage']['error'];
    $dishImageSize = $_FILES['editdishImage']['size'];
    if ($dishImageError == 0) {
      // echo ' No error';
      if ($dishImageSize > 1000000) {
       echo  '<script>alert("Image size is too big!")</script>';
        
      } else {

        $imgEx = pathinfo($dishImageName, PATHINFO_EXTENSION);
        $imgExLwr = strtolower($imgEx);

        $allowedEx = array('jpeg', 'jpg', 'png');

        if (in_array($imgExLwr, $allowedEx)) {

          $newImgName = uniqid("IMG-", true) . '.' . $imgExLwr;
          $img_upload_path = '../uploads/' . $newImgName;
          move_uploaded_file($dishImageTmpName, $img_upload_path);

          // echo $newImgName;
        }
        else{
          echo  '<script>alert("Image format is not valid!")</script>';
        }
      }
  $usql = "UPDATE `dish` SET `category_id` = '$editcatNum',`dish` = '$editDishName' , `image` = '$newImgName' WHERE `id` = $sno";
   
  $result = mysqli_query($connection,$usql);
  if($result){

    $msg='<strong class="text-success">Success! Dish Updated!</strong>'; 
    $alert = true;

  }
  else
   {
    $msg='<strong class="text-danger">Error! Dish Didnt Update</strong>';
    $alert = true;
   }

   }
  

  }


?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>

<body>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <!-- Modal -->

    <!-- Button trigger modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Dish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="dish.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="sno" id="sno" name="sno">
                        <div class="mb-3">
                            <label for="editDishName" class="orderNumberr">Dish Name</label>
                            <input type="text" class="form-control" name="editDishName" id="editorderNumber" required>

                        </div>
                        <div class="my-3 ">
                            <label for="editcatNum" class="form-label">Dish Category </label> <br>
                            <select name="editcatNum" id="categories" required>
                                <option selected> Choose Category </option>
                                <?php 
 
 $resourceSQL = "SELECT * FROM `category` WHERE 1";
 $resourceRES = mysqli_query($connection,$resourceSQL);
 

 while($rowResource = mysqli_fetch_assoc($resourceRES)){
             
   echo '<option  value="'. $rowResource['id'].'" > '. $rowResource['category']. '  </option> ';
 }





?>

                            </select>

                        </div>
                        <div class="my-3">
                            <label for="categoryName" class="form-label">Dish Image</label>
                            <input type="file" class="form-control" id="editdishImage" name="editdishImage" required
                                aria-describedby="emailHelp">
                            <small>Only JPEF/JPG/PNG/format can be uploaded less than 5mb.</small>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update" id="update">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <div class="container bg-gray col-md-9 col-10  d-inline-block float-right mx-2 mb-5 mt-5">
        <h4 class="effect">Dish master</h4>


        <a type="button" href="adddish.php" class="btn btn-outline-dark border border-dark rounded-pill my-3  p-3">Add a
            Dish</a>

        <?php 
if($alert){
  echo '<div class="alert alert-primary d-inline-block w-100 mx-auto alert-dismissible fade show" role="alert">
  '. $msg .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

    ?>


        <!-- Dish Detail Modal script -->

        <!-- Button trigger modal -->

<?php 

 
if(isset($_POST['ddsubmit']) && $_POST['ddsubmit'] == 'true'){
    
    $quantity =  $_POST['quantity'];
    $price =  $_POST['Price']; 
     $dishvalue =  $_POST['dishvalue'];

//    $findDish = mysqli_query($connection,"SELECT * FROM `dish_detail` WHERE `dish_id` = $dishvalue ");
   $n = 0;
   while($quantity[$n]!=''){
       $n++;
   } 
  

    // print_r($quantity);   echo '<br> ';
//     if(mysqli_num_rows($findDish)>0){

       
//            for($i=0;$i<$n;$i++){
//                $quantityPer = $quantity[$i];
//                  $pricePer = $price[$i];    
       
//                  $UQL = "UPDATE `dish_detail` SET `attribute`='$quantityPer',`price`='$pricePer',`status`='1'WHERE `dish_id`='$dishvalue'";
//                $RUql =   mysqli_query($connection,$UQL);
       
//                if(!$RUql){
//                    mysqli_error($connection,$RUql);
//                }
//            }
       
//         }
 

      
//    else{

    for($i=0;$i<$n;$i++){
        $quantityPer = $quantity[$i];
          $pricePer = $price[$i];

          $SQL = "INSERT INTO `dish_detail`( `dish_id`, `attribute`, `price`, `status`)
         VALUES ('$dishvalue','$quantityPer','$pricePer','1')";
        $RSql =   mysqli_query($connection,$SQL);
           
        if(!$RSql){
            mysqli_error($connection,$RSql);
        }

        echo '<script type="text/javascript"> window.location="dish.php";</script>';
    }

 }





   

 









?>
        <!-- Modal -->
        <div class="modal fade" id="dishDetailModal" tabindex="-1" aria-labelledby="dishDetailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dishDetailModalLabel">Adding Dish Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="dish.php" method="post">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            <input type="text" class="form-control" id="quantity" name="quantity[]"
                                                placeholder="Quantity" aria-describedby="emailHelp">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="Price[]"
                                                id="contactNumber" placeholder="Price">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" id="quantity" name="quantity[]"
                                                placeholder="Quantity" aria-describedby="emailHelp">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="Price[]"
                                                id="Price" placeholder="Price">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" id="quantity" name="quantity[]"
                                                placeholder="Quantity" aria-describedby="emailHelp">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="Price[]"
                                                id="Price" placeholder="Price">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" id="quantity" name="quantity[]"
                                                placeholder="Quantity" aria-describedby="emailHelp">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="Price[]"
                                                id="Price" placeholder="Price">

                                        </td>
                                    </tr>
                                    <input type="hidden" name="dishvalue" id="dishvalue">
                                </tbody>
                            </table>


                            <button type="submit" name="ddsubmit" value="true" class="btn btn-lg btn-primary "> Save </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <small>Please Insert all detail acording to the Dish everytime !</small>  <button type="button" class="btn btn-secondary my-2" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>




        <table class="table table-striped mt-3 border" id="myTable">
            <thead class="table-light ">

                <tr>
                    <th scope="col" width="3%">S.No#</th>
                    <th scope="col" width="8%">Dish Category</th>
                    <th scope="col" width="12%">Dish</th>
                    <th scope="col" width="16%">Image</th>
                    <th scope="col mx-2" width="22%">Actions</th>
                    <th scope="col mx-2" width="12%">Added On</th>
                    <th scope="col mx-2" width="8%">Dish Details</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT dish.*,category.category FROM `dish`,`category` WHERE dish.category_id=category.id ";
                $result = mysqli_query($connection, $sql);
                $numRow = mysqli_num_rows($result);
                if ($numRow > 0) {

                    $i = 1;
                    while ($fetchRow = mysqli_fetch_assoc($result)) {


                        echo ' 
                   <tr>
                 <th scope="row">' . $i . '</th>
                 <td> ' .   $fetchRow['category'] . ' </td>    
                 <td>' .   $fetchRow['dish'] . '</td>
                 <td>   <img src=../uploads/' .$fetchRow['image'].' alt="Dish Image" class="img-fluid"> </td>
                 

                 <td class="mt-2"> <a type="button" href="?Id='.$fetchRow['id'].'" class=" edit btn  btn-outline-success my-3" id="'.$fetchRow['id'].'"   data-bs-target="#exampleModal"  data-bs-toggle="modal" > Edit</a> </a> 
                 <input type="hidden"  id="delsno" name="delsno">
                 <a type="button" class=" delete btn  btn-outline-danger my-2" href="?Id='.$fetchRow['id'].'&type=delete"  id="'.$fetchRow['id'].'"> delete</a>
                 
                 ';

                  if($fetchRow['status']=='1'){
                      echo '  <a type="button" class="btn  btn-primary border-dark"  href="?Id='.$fetchRow['id'].'&type=deactive">Active</a> ';

                  }
                  else{
                      echo '<a type="button" class="btn  btn-warning border-dark" href="?Id='.$fetchRow['id'].'&type=active">Deactive </a> ';
                  }
                 
                //   <a href=""><span class="badge bg-primary p-2 my-1 ">Pending</a>
                  
                 echo '</td> <td> ' .   $fetchRow['added_on'] . ' </td> 
                 
                 <td>  <a type="button" class=" btn btn-outline-primary my-2 detail" href="?Id='.$fetchRow['id'].'&type=addDetail"  id="'.$fetchRow['id'].'"   data-bs-toggle="modal" data-bs-target="#dishDetailModal"> Add Details</a> </td> 
                 
                 </tr> ';
                        $i++;
                    }
                } else {
                    echo '<div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> No records found
                  </div>';
                }
                ?>

            </tbody>
        </table>
    </div>
    <!-- Modal -->


    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- Data table cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();




    });
    </script>

<script>
    detail = document.getElementsByClassName('detail')
    dishvalue = document.getElementById('dishvalue')
        Array.from(detail).forEach((element) => {
     element.addEventListener('click', (e) => {
        let link = e.target.id
        dishvalue.value = link
        console.log(dishvalue.value)  
    });
    
});

  </script>



    <script src="script.js"></script>
</body>

</html>