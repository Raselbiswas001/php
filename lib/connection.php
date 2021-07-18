<?php

$host ="localhost";
$user ="root";
$pass ="";
$db   ="phpproject";

$conn = new mysqli($host, $user, $pass, $db);

if( $conn -> connect_error ){

    die( $conn -> error );

}
else{
  
   // echo "<h1>Database Connected</h1>";
}

?>