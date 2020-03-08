<!-- This is the page that returns the description for a psychopathology that already exists
     in the database. If it does not exist, then it prompts users -->
<div class='div_background'>

<!-- connection information for the database -->
<?php include "../database/database-connection.php" ?>

<!-- connection information for the database -->
<?php include "../settings/header.html" ?>

<!-- start php script -->
<?php
    // getting the form  search input from psych-search.html
    $path_search = $_POST['path_search'];

    //echoing out what the user entered to browser as didn't work below in if statement
    echo htmlspecialchars($path_search); 
    
    //sql connection to database from include..
    $db_connection = databaseConnection();
    
    //creating mysql code that will select everything in the pathology table ROW!!! where the
    // path_name column is exactly to what the user entered ('schizophrenia')
    $search_term = "SELECT * FROM pathology WHERE path_name='$path_search'";

    //sending the mysql query to the mysql database
    $search_for_path = mysqli_query($db_connection, $search_term);

    //getting the single result and putting it into a php array
    $search_result = mysqli_fetch_assoc($search_for_path);


    // if the user enters nothing in the html form, throw an error
    try{
        if(empty($path_search) || (ctype_space($path_search)) || ($path_search = '')){
            throw new Exception ("You did not enter a search term.");
        }
        // if a mysql query does not return anything because it does not exist in the database, then
        // the variable is given the value of NULL
        if($search_result == NULL){
            echo " does not exist in database yet. Would you like to <a href='/psych-db'>ENTER</a> one?";
        
        /* if what the user entered DOES exist in the database, take that row of information but only print out the
        PATH_DESCRIPTION COLUMN, not the id, or path_name, or time etc */
        }else{
            echo($search_result['path_description']);
        }
    // catching the exception if the user did not enter anything into the field.
    }catch (Exception $err){
        echo htmlspecialchars($err->getMessage());
    }


    




?>
</div>
