<?php 

session_start();

if (isset($_SESSION['auth'])) {
  if($_SESSION['auth'] == 1) {
    header("location:index.php");
  }
}else {
  if (isset($_COOKIE['auther'])) {
    if ($_COOKIE['auther'] == true) {
      header("location:index.php");
    }
  }
}

// db connect
  include "lib/connection.php";

$notify = null;

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $checkbox = isset($_POST['checkbox'])?1:0;





  if ($email == "a@gmail.com" && $pass == "1234") {
    $_SESSION['auth'] = 1;
     if($checkbox== 1){
      setcookie('auther',true, time()+(60*60*24*14),'/');
    }


    header("location:index.php");
  } else {
    $notify = "Invalid Email & Password";
  }

}







?>




<!doctype html>  
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Log In</title>
  </head>
  <body>
   <div class="container">
    <div class="row pt-5">
      <div class="mx-auto col-lg-5 mb-5 pt-5">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
            <label class="form-check-label" for="checkbox">Check me out</label>
          </div>
          <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>

        <div>
          <p class="mt-2"><strong><?php echo $notify; ?></strong></p>
        </div>
      </div>
    </div>
  </div>


        <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <div>
      <?php echo $notify; ?>
    </div>


  </body>
</html>
