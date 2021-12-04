<?php
$msg ="";
$alert = false;
require '../_dbConnect.php';
session_start();
$page=="deliveryboy";
if (!$_SESSION['loggedIn']) {

    header("location:_logIn.php");
}

 include './_top.php';
    
 if((isset($_GET['Id']))  && isset($_GET['type']))
 {



    if($_GET['type'] == 'active' || $_GET['type'] == 'deactive')

    {
        $status=1;
        $Id = $_GET['Id'];
       
         if($_GET['type'] == 'deactive')
         {
            $status=0;
         }
            
         $Usql = " UPDATE `delivery_boy` SET `status`='$status' WHERE `id` = $Id";
         $result =mysqli_query($connection,$Usql);
         echo '<script type="text/javascript"> window.location="deliveryBoy.php";</script>';
        //  header("location:deliveryBoy.php");
      
      
    }


  }
  

  if(isset($_POST['sno'])){

 $editName = $_POST['editDeliveryManName'];
   $editnum =  $_POST['editDeliveryManNumber'];
   echo  $sno = $_POST['sno'];
    
    $usql = "UPDATE `delivery_boy` SET `name` = '$editName', `mobile` = '$editnum' WHERE `id` = $sno";

  $result = mysqli_query($connection,$usql);
  if($result){
    $msg='<strong class="text-success">Success! DeliveryBoy detail updated!</strong>'; 
    $alert = true;

  }
  else
   {
    $msg='<strong class="text-danger">Error! Couldnt Update</strong>';
    $alert = true;
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
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
</head>

<body>


    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Delivery Man Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="deliveryBoy.php" method="post">
                        <input type="hidden" name="sno" id="sno">
                        <div class="my-3 ">
                            <label for="editDeliveryManName" class="form-label">Delivery Man  Name</label>
                            <input type="text" class="form-control" id="editcategoryName" name="editDeliveryManName">
                               
                        </div>
                        <div class="mb-3">
                            <label for="orderNumber" class="orderNumberr">Contact Number</label>
                            <input type="number" class="form-control" name="editDeliveryManNumber" id="editorderNumber"
                                required>

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

    <div class="container bg-gray col-12 col-md-9 d-inline-block float-right mx-2  mt-5 mb-5">
        <h4 class="effect">Delivery  Master</h4>

        <a type="button" href="addDeliveryBoy.php" class="btn btn-outline-dark border border-dark rounded-pill my-3  p-3">Add a Delivery </a>
       
        <?php 
if($alert){
  echo '<div class="alert alert-primary d-inline-block w-100 mx-auto alert-dismissible fade show" role="alert">
  '. $msg .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



    ?>
       
        <table class="table table-striped mt-3 border" id="myTable">
            <thead class="table-light ">

                <tr>
                    <th scope="col" width="10%">S.No#</th>
                    <th scope="col" width="20%">User name</th>
                    <th scope="col" width="20%">Mobile</th>
                   
                    <th scope="col mx-2" width="20%">Actions</th>
                    <th scope="col" width="30%">Added on</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM `delivery_boy` WHERE 1";
                $result = mysqli_query($connection, $sql);
                $numRow = mysqli_num_rows($result);
                if ($numRow > 0) {

                    $i = 1;
                    while ($fetchRow = mysqli_fetch_assoc($result)) {


                        echo ' 
                   <tr>
                 <th scope="row">' . $i . '</th>
                 <td> ' .   $fetchRow['name'] . ' </td>
                 <td>' .   $fetchRow['mobile'] . '</td>
                

                 <td> <a type="button" href="?Id='.$fetchRow['id'].'" class=" edit btn  btn-outline-success my-3" id="'.$fetchRow['id'].'"   data-bs-target="#exampleModal"  data-bs-toggle="modal" > Edit</a> </a> 
                 <input type="hidden"  id="delsno" name="delsno">
                 
                 
                 ';

                  if($fetchRow['status']=='1'){
                      echo '  <a type="button" class="btn  btn-primary border-dark"  href="?Id='.$fetchRow['id'].'&type=deactive">Active</a> ';

                  }
                  else{
                      echo '<a type="button" class="btn  btn-warning border-dark" href="?Id='.$fetchRow['id'].'&type=active">Deactive </a> ';
                  }
                 
                //   <a href=""><span class="badge bg-primary p-2 my-1 ">Pending</a>
                  
                 echo '</td> <td> ' .   $fetchRow['added_on'] . ' </td>  </tr> ';
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
     <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
          $('#myTable').DataTable();

        } 


       );

  </script>
    <script src="script.js"></script>
</body>

</html>