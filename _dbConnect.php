<?php 

  $server="localhost";
  $user="root";
  $password="";
  $dbName="foodorder";

  $connection=mysqli_connect($server,$user,$password,$dbName);

   if(!$connection){

   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong>We are having some troubles with Database. Try again later
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';


   }
    

  



 ?>