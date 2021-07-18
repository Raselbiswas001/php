<?php 

// db connection 
include "connection.php";

// upadte query

if( isset($_POST['s_update'])){

   $u_id    = $_POST['edit_id'];
   $name    = $_POST['s_name'];
   $email   = $_POST['s_email'];
   $gender  = $_POST['s_gender'];
   $age     = $_POST['s_age'];

   $update_sql = "UPDATE students SET name='$name', email='$email', gender=$gender, age=$age WHERE id=$u_id";

   if($conn -> query($update_sql)){

    header("location:../index.php");
   }else{
    die( $conn -> error);
   }
}

// selected query
if( isset($_GET['id'])){

  $edit_id = $_GET['id'];

  $select_sql = "SELECT id, name, email, gender, age FROM students WHERE id= $edit_id";

  $s_query = $conn -> query($select_sql);

  if( $s_query -> num_rows > 0){

  while( $f_data = $s_query -> fetch_assoc()){

?>
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Page</title>
  </head>
  <body>
    <section class="data_edit">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <!-- form -->
               <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                 <h1 class="text-info">Enter Student Data</h1>

                 <input type="hidden" value="<?php echo $f_data['id'];?>" name="edit_id">
                 <!-- name -->
                    <div class="mb-3">
                         <label for="s_name " class="form-label">Enter Your Full Name</label>
                           <input type="text" value="<?php echo $f_data['name']; ?>" class="form-control s_name" name="s_name" id=" s_name" required  >
                    </div>
                    <!-- email -->
                     <div class="mb-3">
                         <label for="s_email " class="form-label">Enter Your Email Address</label>
                           <input type="email" value="<?php echo $f_data['email']; ?>" class="form-control s_email" name="s_email" id=" s_email" required  >
                    </div>
                    <!-- gender-->
                    <div class="mb-3">
                      <label for=" s_gender" class="form-label">Enter Your Gender</label>
                       <select class="form-select s_gender" id="s_gender"  name="s_gender">
                        <option value="0" <?php if($f_data['gender'] == 0 ) { echo "Selected"; } ?>>Male</option>
                        <option value="1" <?php if($f_data['gender'] == 1 ) { echo "Selected"; } ?>>Female</option>
                      </select>
                    </div>
                <!-- age -->
                     <div
                      class="mb-3">
                         <label for="s_age " class="form-label">Enter Your  Age</label>
                           <input type="number" value="<?php echo $f_data['age']; ?>" class="form-control s_age" name="s_age" id=" s_age" required >
                    </div>
                   <!-- submit -->
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary" name="s_update">Update</button>
                      <button type="reset" class="btn btn-danger">RESET</button>
                    </div>
                  </form>
            <!-- form -->
          </div>
        </div>
      </div>
    </section>

 <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
  </body>
</html> 
<?php 


    }

  }else{

  header("location:../index.php");

  }
}else{

  header("location:../index.php");

}
?>




