<!-- css stylesheet -->
<link rel="stylesheet" href="../settings/stylesheet.css">

<!-- include the header.html file that is in the psych-db folder. -->
<?php include "../settings/header.html"; ?>

<!-- connection information for the database -->
<?php include "../database/database-connection.php" ?>
<?php $db_connection = databaseConnection(); ?>


<!--  the css code for .div_background is in a css file in this folder that is lined
      inside of the header.html-->
<div class='div_background'>


<!-- where user puts in what to delete -->
<form action="deleting-value.php" method="post">
      <input type='text' name='delete_option' placeholder='psychopathology to delete'></input>
      <input type=submit name='submit' value='submit'></input>
</form>

<!-- displays all of the  -->
<h3> Psychopatholgy's in database </h3>
<?php
      $query_psychopatholgy = "SELECT path_name FROM pathology";
 
      $make_query = mysqli_query($db_connection, $query_psychopatholgy);
      
      $store_result = mysqli_fetch_all($make_query, MYSQLI_ASSOC);
      if(empty($store_result)){
            echo "database is empty";
      }
      foreach($store_result as $res){
            print_r($res['path_name']);
            echo "<br>";
      }

?>

<?php include "../settings/sitemap.html" ?>
</div>