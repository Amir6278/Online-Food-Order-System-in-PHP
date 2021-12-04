 <!-- adding dish script with photo upload  -->


<?php
$msg = "";
$alert = false;

require '../_dbConnect.php';
session_start();

if (!$_SESSION['loggedIn']) {

  header("location:_logIn.php");
}
include './_top.php';

if (isset($_POST['submit'])) {
  $name = $_POST['dishName'];
  $dishdec = $_POST['dishdec'];
  $editcatNum = $_POST['editcatNum'];
  $dishImage = $_FILES['dishImage'];


  $checkExist = "SELECT * FROM `dish` WHERE `dish`= '$name'";

  if (mysqli_num_rows(mysqli_query($connection, $checkExist)) > 0) {

    $msg = '<strong class="text-danger">Error! Dish Already Exist!</strong>';
    $alert = true;
  } else {

    $dishImageName = $_FILES['dishImage']['name'];
    $dishImageType = $_FILES['dishImage']['type'];
    $dishImageTmpName = $_FILES['dishImage']['tmp_name'];
    $dishImageError = $_FILES['dishImage']['error'];
    $dishImageSize = $_FILES['dishImage']['size'];
    if ($dishImageError == 0) {
      // echo ' No error';
      if ($dishImageSize > 10000) {
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
    }

    $Isql = " INSERT INTO `dish` (`category_id`, `dish`, `dish_detail`,`image`,`status`) VALUES ('$editcatNum', '$name','$dishdec','$newImgName', '1')";

    $result = mysqli_query($connection, $Isql);

    if ($result) {
      $msg = '<strong class="text-success">Success! Item Added!</strong>';
      $alert = true;
    }
    else{
      $msg = '<strong class="text-danger">Sorry! Item Check your inputs and put valid credentials!</strong>';
      $alert = true;
    }
  }
}


?>

<div class="row addcontainer">

<div class="col-md-7">
    <?php
    if ($alert) {
      echo '<div class="alert alert-warning d-inline-block w-100 mx-auto alert-dismissible fade show" role="alert">
  ' . $msg . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }



    ?>
    <h4 class="display-6 my-3">Add a Dish</h4>
    <form action="adddish.php" method="post" enctype="multipart/form-data">

      <div>
        <label for="orderNumber" class="form-label">Select category</label> <br>
        <select name="editcatNum" class="form-label" id="categories" required>
          <option selected> Choose Category </option>
          <?php

          $resourceSQL = "SELECT * FROM `category` WHERE 1";
          $resourceRES = mysqli_query($connection, $resourceSQL);


          while ($rowResource = mysqli_fetch_assoc($resourceRES)) {

            echo '<option  value="' . $rowResource['id'] . '" > ' . $rowResource['category'] . '  </option> ';
          }


          ?>

        </select>
      </div>
      <div class="my-3">
        <label for="categoryName" class="form-label">Dish Name</label>
        <input type="text" class="form-control" id="categoryName" name="dishName" required aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="orderNumber" class="orderNumberr">Dish detail</label>
        <textarea name="dishdec" id="dishdec" class="form-control" cols="6" rows="3" required></textarea>
      </div>
      <div class="my-3">
        <label for="categoryName" class="form-label">Dish Image</label>
        <input type="file" class="form-control" id="dishImage" name="dishImage" required aria-describedby="emailHelp">
        <small>Only JPEF/JPG/PNG/format can be uploaded less than 5mb.</small>
      </div>
      <button type="submit" name="submit" class="btn btn-primary mt-2">Add</button>
    </form>

  </div>
</div>