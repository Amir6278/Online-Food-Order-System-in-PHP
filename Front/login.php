

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <link rel="stylesheet" href="style.css">
    <title>Log In</title>
  </head>
  <style>
      body{
          background: url('b.jpg') top center;
          background-attachment: fixed;
          background-size: cover;
      }
      .form-text{
        font-weight: bold;
        margin:0 auto;
        padding: 0;
      }
  </style> 
  
<script>

function validate(event){
 
 
 const email =   document.getElementById('email');
 const password =   document.getElementById('password');

//  console.log( )

    
  if(email.value == '' || email.value==null){
  event.preventDefault();
document.getElementById('emailError').innerHTML = "Enter a registered e-mail !";
  email.focus();
  return false;
}


else  if(password.value == '' || password.value==null ){
  event.preventDefault();
  document.getElementById('passwordError').innerHTML= " Enter your Password";
document.getElementById('passwordError').style.color = "red";
  mobile.focus();
  return false;
}

else{
  return true;
}



}



</script>
  <body>
    
     <!-- alerts of innserting data -->
 
      <?php
      $ErrorAlert=false;
      $successAlert=false;
       $ErrorMessage="";
       $SuccessMessage="";
       require_once('../_dbConnect.php');
    require_once('_header.php');

   if(isset($_POST['login'])){


      $email = $_POST['useremail'];
     $password = $_POST['userpassword'];


      $available = "SELECT * FROM `user` WHERE `email` = '$email'  ";
      $availableResult = mysqli_query($connection,$available);
       $num = mysqli_num_rows($availableResult);
      //  echo $num;
      if($num == 1)
      {
       
          while($row = mysqli_fetch_assoc($availableResult)){

           if(password_verify($password,$row['password']))
          {
 
 
            $successAlert=true;
          
           session_start();
           $_SESSION['loggedIn'] = true;
           $_SESSION['name'] = $row['name'];
           $_SESSION['userId'] = $row['id'];
           echo '<script type="text/javascript"> window.location="home.php"; </script>';
 
           }
          else{
            $ErrorMessage = "Invalid Password";
            $ErrorAlert=true;
         }



          }
          
         

      }



   }

   else{
    $ErrorMessage = "Account Doesn't Exist";
    }



  if($ErrorAlert){
         echo " <div class='alert alert-danger alert-dismissible fade show' role='alert fw-bold'>
         <strong>  <i class='fas fa-exclamation-triangle mx-2'></i>Error!</strong> " . $ErrorMessage . "
         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>'";
  }


  ?>
    <div class="container mx-auto mt-5  center" >

         <div class="row  shadow-lg mt-5 myrow rounded">
           <div class="col-12">
            <form action="login.php" method="POST">
              <div class="row my-2">

         <div class="col-12 mb-1">               
                  <span class="text-success"><h3 class="text-center"> <i class="fas fa-user-lock text-success fa-2x"></i> Log In</h3></span>
              

                </div>
   
              </div>
            
            <div class="mb-0">

              <div class="row mb-1">

                <div class="col-md-1 col-1 mt-2">
                  <span><i class="fas fa-envelope-open"></i></span>
                </div>
                <div class="col-md-11 col-11">
                  <input type="email" class="form-control mb-1" name="useremail" id="email" aria-describedby="emailHelp" placeholder="example@mail.com">
                  <p class="form-text mb-3 text-danger" id="emailError"></p>
                
                </div>
              </div>


             
            </div>

            <div class="mb-0">

              <div class="row mb-1">

                <div class="col-md-1 col-1 mt-2">
                  <span><i class="fas fa-user-cog mr-1"></i></span>
                </div>
                <div class="col-md-11 col-11">
                  <input type="password" class="form-control mb-1" name="userpassword" id="password" placeholder="Password">
                  <div id="passwordError"  class="form-text mb-3">Make Sure to use the correct password.</div>
                </div>
              </div>
              
                  <div class="row">
                 <div class="col-12">
                    <button type="submit" class="btn rmybtn btn-success  btn-sm w-100 mx-auto mb-2" onclick = validate(event) name="login"><i class="fas fa-unlock-alt mx-2"></i>Log In</button>

                    <div id="emailHelp"  class="form-text mb-3"><a href="forgotpassword.php" class="text-primary mx-3">Forgot Password?</a><a href="register.php" class="text-primary ">Don't Have an Account?</a>.</div>
                </div>
                 </div>
          </form>
          
           </div>
         </div>

    </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
 
</html>