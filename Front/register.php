

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

    <title>Sign Up</title>
  </head>
  <style>
      body{
          background: url('finebanner.jpg') top center;
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

function validate(){
 
  const name =   document.getElementById('name');
 const email =   document.getElementById('email');
 const mobile =   document.getElementById('mobile');
 const password =   document.getElementById('password');
 const cpassword =   document.getElementById('cpassword');
//  console.log( )

       if(name.value == '' || name.value==null ){
        event.preventDefault();
      document.getElementById('nameError').innerHTML = "Enter your name !";
        name.focus();
        return false;
  }
 else  if(email.value == '' || email.value==null){
  event.preventDefault();
document.getElementById('emailError').innerHTML = "Enter a valid E-mail !";
  email.focus();
  return false;
}


else  if(mobile.value == '' || mobile.value==null ){
  event.preventDefault();
document.getElementById('numberError').innerHTML = "Enter Your mobile!";
  mobile.focus();
  return false;
}
else  if(password.value == '' || password.value==null ){
  event.preventDefault();
document.getElementById('passwordError').innerHTML = "Enter your password !";
  mobile.focus();
  return false;
}



else  if (cpassword.value == '' || cpassword.value==null ){
  event.preventDefault();
  document.getElementById('cpasserror').style.color = "red";
     cpassword.focus();
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
  require_once('../_dbConnect.php');
   require_once('_header.php');
   $ErrorMessage="";
   $errorAlert=false;

   $successalert=false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST['submit']) && $_POST['submit']=='register'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $location = $_POST['location'];
   
     $exitUserSQL= mysqli_query($connection,"SELECT * FROM `user` WHERE `email` = '$email' ");
         
     $exitUser = mysqli_num_rows($exitUserSQL);
   
   
      if($exitUser>0){
          $ErrorMessage = "User  Already Exists";
          $errorAlert = true;
   
      }
      else{
           
       if($password != $cpassword)
       {
           $ErrorMessage = "Password Didn't Match";
          $errorAlert = true;
        }
        else{
               $hash = password_hash($cpassword,PASSWORD_DEFAULT);
   
         $InsertSQL= " INSERT INTO `user`( `name`, `email`, `password`, `mobile`,`address`, `status`) VALUES ('$name','$email','$hash',' $mobile','$location','1') ";
         $InsertSQLresult=mysqli_query($connection,$InsertSQL);
         if($InsertSQLresult==1){
           //  echo ' inserted';
           $successalert=true;
         }
         else{
            $ErrorMessage = "Failed";
             $errorAlert = false;
     
         }
   
        }
   
      }
   
      }
     if($errorAlert){
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
     <strong><i class='fas fa-exclamation-triangle mx-2'></i>  Error!   </strong>"   . $ErrorMessage. " 
     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
   </div>";
     }
     if($successalert){
       echo "<div class='alert alert-success alert-dismissible fade show ' role='alert'>
      <strong><i class='fas fa-check-circle'></i> Success!   </strong> You Have Successfully Registered.  <a href='login.php' class='text-success fw-bold'> Log In  </a> with these Credential's to Continue.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
      }
    
    }
   


  ?>



    <div class="container mx-auto center" >

         <div class="row  shadow-lg mt-2 myrow">
           <div class="col-12">
            <form action="register.php" id="registerForm"  method="post">
              <div class="row mt-2">

         <div class="col-12 mb-4">               
                  <h3 class="text-center text-success"> <i class="fas fa-users text-success"></i>  Register to site</h3>
            
                </div>
                
             
              </div>
            
            <div class="mb-0">
              <div class="row mb-1">

                <div class="col-md-1 col-1 col-xs-1 mt-2">
                  <span><i class="fas fa-user-tie"></i></span>
                </div>
                <div class="col-md-11 col-11 col-xs-11">
                  <input type="name" class="form-control mb-1" id="name" name="name" maxlength="15" aria-describedby="name"  placeholder="User Name" >
                  <p class="form-text mb-3 text-danger" id="nameError"></p>
                </div>
              </div>
            
          
 
              <div class="row mb-1">

                <div class="col-md-1 col-1 mt-2">
                  <span><i class="fas fa-envelope-open"></i></span>
                </div>
                <div class="col-md-11 col-11">
                  <input type="email" class="form-control mb-1" name="email" id="email" aria-describedby="emailHelp" placeholder="example@mail.com" >
                  <p class="form-text mb-3 text-danger" id="emailError"></p>
                
                </div>
              </div>
   



              <div class="row mb-1">

<div class="col-md-1 col-1 mt-2">
  <span><i class="fas fa-phone"></i></span>
</div>
<div class="col-md-11 col-11">
  <input type="tel" class="form-control mb-1" name="mobile" id="mobile" aria-describedby="emailHelp" placeholder="Phone Number" >
  <p class=" form-text mb-3 text-danger" id="numberError"></p>
</div>
</div>

             
            </div>

            <div class="mb-0">

              <div class="row mb-1">

                <div class="col-md-1 col-1 mt-2">
                  <span><i class="fas fa-user-cog mr-1"></i></span>
                </div>
                <div class="col-md-11 col-11">
                  <input type="password" class="form-control mb-1" name="password" id="password" placeholder="Password" >
                  <p class=" form-text mb-3 text-danger "  id="passwordError"></p>
                </div>
              </div>
              
           <div class="row mb-1">

                <div class="col-md-1 col-1 mt-2">
                  <span><i class="fas fa-user-check"></i></span>
                </div>
                <div class="col-md-11 col-11">
                  <input type="password" class="form-control mb-1" name="cpassword" id="cpassword" placeholder=" Confirm Password" >
                 
                  <div  class="form-text mb-3" id="cpasserror" >Make Sure to use the same password.</div>
                </div>
              </div>
              <div class="row mb-1">

<div class="col-md-1 col-1 my-2">
  <span><i class="fas fa-search-location"></i></span>
</div>
<div class="col-md-11 col-11">
  <input type="text" class="form-control mb-1" name="location" id="location" placeholder="Location" >

</div>
</div>
            </div>
            
     
   <div class="row">
     <div class="col-12">
    
                    <button type="submit" id="RegSubmit" onclick = "return validate(event)" class="btn rmybtn btn-success w-100 mx-auto mb-2" value="register" name="submit"><i class="fas fa-user-plus mx-2"></i> REGISTER</button>
                    <div id="emailHelp"  class="form-text mb-3"><a href="login.php" class="mx-1">Already Have an Account?</a>
                    <a href="contact.php">Need Help?</a>
                  </div>
                   
     </div>
              </div>
          </form>
          
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