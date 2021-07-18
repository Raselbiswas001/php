<?php

// session start
session_start();

if(isset($_SESSION['auth'])){
     if (isset($_SESSION['auth']) != 1) {

            header("location:login.php");

     }

}else{
    if(isset($_COOKIE['auther'])){
       if($_COOKIE['auther'] != true){
                  header("location:login.php"); 

      }

    }else{
      header("location:login.php");
    }


  
}


// db connect
include "lib/connection.php";

$result = null;
// data insert

if( isset( $_POST['u_submit'] ) ){
    
    $name   = $_POST['u_name'];
    $email  = $_POST['u_email'];
    $gender = $_POST['u_gender'];
    $age    = $_POST['u_age'];
    $pass   = md5($_POST['u_pass']);
    $cpass  = md5($_POST['c_pass']);

if( $pass == $cpass ){
  $insertsql = "INSERT INTO students( name, email, gender, age, pass) VALUES 
  ( '$name', '$email', $gender, $age, '$pass' )";

  if ( $conn -> query($insertsql) ) {
    $result = "<h2 class='text-success'>Data Inserted Successfully</h2>";
  }else{
    die( $conn -> error );
  }

}else{
  $result = "<h2 class='text-danger'>Password Not Matched</h2>";
}

} 

// data select
$select_sql = "SELECT * FROM students";

$r_sql = $conn -> query($select_sql);

  echo $r_sql -> num_rows;

?>


<!doctype html>  
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>SMS</title>
  </head>
  <body>
    <h1 class="text-info">Enter Student Data</h1>
    <section class="data_collect">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <!-- form -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
              <div class="mb-3">
                <label for="u_name" class="form-label">Enter Your Full Name</label>
                <input type="text" class="form-control u_name" id="u_name" name="u_name" required>
              </div>
              <div class="mb-3">
                <label for="u_email" class="form-label">Enter Your Email Address</label>
                <input type="email" class="form-control u_email" id="u_email" name="u_email" required>
              </div>

              <div class="mb-3">
                <label for="u_gender" class="form-label">Gender</label>
                <select class="form-select u_gender" id="u_gender" name="u_gender">
                  <option value="0">Male</option>
                  <option value="1">FeMale</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="u_age" class="form-label">Enter Your Age</label>
                <input type="number" class="form-control u_age" id="u_age" name="u_age" required>
              </div>
              <div class="mb-3">
                <label for="u_pass" class="form-label">Enter Your Password</label>
                <input type="password" class="form-control u_pass" id="u_pass" name="u_pass" required>
              </div> 
              <div class="mb-3">
                <label for="c_pass" class="form-label">Confirm Your Password</label>
                <input type="password" class="form-control c_pass" id="c_pass" name="c_pass" required>
              </div>                                             
              <button type="submit" class="btn btn-primary" name="u_submit">Submit</button>
              <button type="reset" class="btn btn-primary">Reset</button>
            </form>
            <!-- form -->
          </div>

          <div class="col-lg-12">
            <?php echo $result; ?>
          </div>


        </div>
      </div>
    </section>
    <div class="data_show">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- table -->
            <table class="table table-dark table-striped table-hover text-center">

              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Action</th>
              </tr>

                <?php if ($r_sql -> num_rows > 0 ) { ?>
                <?php while ( $f_data = $r_sql -> fetch_assoc() ) {
                ?>
              <tr>
  
                <td><?php echo $f_data['name']; ?></td>
                <td><?php echo $f_data['email']; ?></td>
                <td><?php if( $f_data['gender'] == 0 ){echo "Male";}else { echo "Female";} ?></td>
                <td><?php echo $f_data['age']; ?></td>
                <td>
                  <a href="lib/edit.php?id=<?php echo $f_data['id'];?>">Edit</a>
                  <a href="lib/delete.php?id=<?php echo $f_data['id'];?>">Delete</a>
                </td>

              </tr>
              <?php } ?>
              <?php } else{ ?>

              <tr>
               
                <td colspan="5"><p class="mb-0">No Data To Show</p></td>

              </tr>
              <?php } ?>
            </table>

            <!-- logout -->
            <a href="logout.php">Logout</a>

          </div>
        </div>
      </div>
    </div>

   
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
  </body>
</html>

