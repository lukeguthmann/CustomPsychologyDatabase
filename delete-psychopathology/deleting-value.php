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

<?php
    // what the user entered to delete
    $user_wants_to_delete = mysqli_real_escape_string($db_connection, $_POST['delete_option']);

    // if the user enters only spaces
    if((empty($user_wants_to_delete)) || ctype_space($user_wants_to_delete)){
        echo 'No psychopathology entered to delete';
        echo "<br>";
    }
    
    //checking to see if name is in database
    $check_query = "SELECT path_name FROM psychopathologyDB.pathology";
    $send_check_query = mysqli_query($db_connection, $check_query);
    $save_check_query = mysqli_fetch_all($send_check_query, MYSQLI_ASSOC);

    // if the database is empty, tell the user because the foreach command below has nothing to cycle through
    if(empty($save_check_query)){
        echo "nothing in database to delete.";
    }


    foreach($save_check_query as $check){

        if($_POST['delete_option'] == ($check['path_name'])){
         
         //constructing the delete query. Make sure you have the ' ' around the variable.
        $construct_query = "DELETE FROM psychopathologyDB.pathology 
                            WHERE path_name='$user_wants_to_delete'";

        // sending the delete query
        $send_query = mysqli_query($db_connection,$construct_query);
        echo htmlspecialchars("deleted " .  $_POST['delete_option'] .  " from database.");
        $path_does_not_exist = true;
        break;

        }else{
            $path_does_not_exist = false;       
        }
    }
    if($path_does_not_exist == false){
        echo htmlspecialchars($_POST['delete_option'] . " does not exist in database");
    }

   
?>
<?php include "../settings/sitemap.html" ?>
</div>
