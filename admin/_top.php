

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!--Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<?php $page=""; ?>

<body>



    <nav class="navbar fixed-top navbar-expand-lg navbar-expand-lg navbar-light bg-secondary mb-5">
        <div class="container-fluid d-flex justify-content-between">
        <button  class="btn  btn-lg rounded-pill mx-2 my-3 fas fa-align-justify mybtn" type="button" data-toggle="collapse"
                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               
            </button>
                <ul class="navbar-nav myNav">
                     <li class="nav-item ">  <a class="navbar-brand" href="index.php"><img src="cooking.png" class="img-fluid myNavBrand" alt="" srcset=""> <strong class="myNavBrandText mt-2">
                Food Order System</strong></a> </li>
                    <li class="nav-item dropdown mx-5 mt-2">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                             <button type="button" class="btn btn-light border-dark">
                                <i class="fas fa-user-cog fa-2x"></i> <?php echo  substr($_SESSION['name'],0,20);?><strong>
 
                                </strong> <span 
                                    class="badge bg-secondary mt-1"></span>

                            </button>  

                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdown">

                            <li> <a class="dropdown-item mt-2 " href="#"> <i class="fas fa-user-shield"></i>
                                        Profile </a></li>
                            <li><a class="dropdown-item mt-2 " href="_logOut.php"> <i class="fas fa-sign-out-alt"></i>
                                    LogOut </a></li>
                        </ul>
                    </li>
                </ul>
         
        </div>
    </nav>




    <!-- Sidebar -->
    <div class="sidebar col-md-2 rounded p-2 text-wrap sticky-right">

    <div class="user_part">
            <img src="avatar.png" alt="" srcset="">
            <h4 class="fw-bold lead"><?php echo  substr($_SESSION['name'],0,05);?></h4>
            <p><i class="fa fa-circle"></i> Online</p>
          </div>
        <ul class="list-group mt-3 ">
            <li class="side-item" ><a class="sidelink"  href="category.php" >  <span><i class="fa fa-list-alt"></i></span> Category</a></li>
            <li class="side-item"><a class="sidelink" href="user.php">  <span><i class=" fas fa-user-tie"></i></span> Users</a></li>
            <li class="side-item"><a class="sidelink "  href="deliveryBoy.php"> <span><i class="fas fa-biking"></i></span>  Delivery Boy</a></li>
                
            
            <li class="side-item"><a class="sidelink "  href="couponCode.php"><span><i class=" fas fa-gem""></i></span>  CouponCode</a></li>
            <li class="side-item"> <a class="sidelink"  href="dish.php"><span><i class=" fas fa-utensils"></i></span>  Dish</a></li>
            <li class="side-item"> <a class="sidelink"  href="ordermaster.php"><span><i class="fas fa-external-link-square-alt"></i></span>  Order Master</a></li>


         





    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <script src="main.js"></script>
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>