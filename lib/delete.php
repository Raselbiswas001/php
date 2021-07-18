<?php

  // db connection  

include "connection.php";

 // data delete 
if ( isset($_GET['id']) ) {
	
	// echo $_GET['id'];

	$delete_id = $_GET['id'];

    $delete_sql = "DELETE FROM students WHERE id = $delete_id";

    if( $conn -> query ( $delete_sql ) ){

     header( "location:../index.php");

    }else{

    die( $conn -> error );

    }
}else{
	
	header( "location:../index.php");
}

?>