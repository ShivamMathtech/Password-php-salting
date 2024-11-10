<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registartion with Salting technique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
   if(isset($_GET['registration'])){
      
      
      // Check if password and confirm password match
      if($pass!= $cpass){
        echo "<div class='alert alert-danger mt-3' role='alert'>Passwords do not match</div>";
        exit();
      }else{
         // DB connection on
         $conn = @mysqli_connect("localhost","root","","ecom_2_db") or die("could not connection stablish");
           // build the query
           $name = mysqli_real_escape_string($conn , $_GET["name"]);
           $pass = mysqli_real_escape_string($conn , $_GET["pass"]);
           $email = mysqli_real_escape_string($conn , $_GET["email"]);
            // Generate a random salt
        $salt= mt_rand(10,10000);
          $hashed_psd= hash('sha512',$salt.$pass.$salt)  ;
            $sql = "INSERT INTO user_tbl(`fanme`,`email`,`password` ,`salt`) VALUES ('$name','$email','$pass')";
           // execute the query
      
           // display the results


         mysqli_close($conn);
         // Db connection close
      }
      
      
     
   }
 
 ?>
    <form action="<?php
    echo $_SERVER['PHP_SELF']
    ?>" method="GET" class="w-50 offset-3 mt-3">
        <h1 class="text-center">Registartion Form</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="pass" required>
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpass" required>
        </div>
        <input type="submit" class="btn btn-primary" name="registration" value="submit">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>