<!-- This is a PHP page. It is used for accepting the psych-db.html form inputs and inserting them
     into a mysql database if [1] the psychopathology name does not already exist [2] - if they put
     in a psychopathology name (an empty name does not rejects the field)  -->

<!-- css stylesheet -->
<link rel="stylesheet" href="../settings/stylesheet.css">

<!-- include the header.html file that is in the psych-db folder. -->
<?php include "../settings/header.html"; ?>

<!-- connection information for the database -->
<?php include "../database/database-connection.php" ?>

<!--  the css code for .div_background is in a css file in this folder that is lined
      inside of the header.html-->
<div class='div_background'>

<!-- starting the php script -->
<?php

// three variables that collect the html raw form input input information that the user POSTED
function formAnswers(){
    $path_name = $_POST['path_name'];
    $path_symptoms = $_POST['path_symptoms'];
    $path_description = $_POST['path_description'];
    return[$path_name, $path_symptoms, $path_description];
    }
list($path_name, $path_symptoms, $path_description) = formAnswers();


//creating connection to mysql database
// function databaseConnection(){
//     $db_connection = mysqli_connect('localhost', 'shaun', 'root', 'psychopathology');
//     if(!$db_connection){
//         echo 'database error:' . mysqli_connect_error();
//     }else {
//         return $db_connection;
//     } }
$db_connection = databaseConnection();

//---------------------------------------------- 
//      if the pathology name was empty, set it ot null
    try{
        if ((empty($path_name)) || ctype_space($path_name) || ($path_name == '')) {

            /* This is the path_name variables I created earlier with the user input I have ultimately said here 
               that is the the user did not enter anything at all (so spaces or left empty) then change that empty
               string to a null value. This null value comes in handy when you are trying to input the data into mysql
               down below in if($path_name == false). where if it is, I don't want to do anything because the information
               that is important for the user has already been printed out down below such as already exists in dicitonary or
               no symptoms entered, no description entered etc. There is a cleaner way to do this but I should have started with
               OOP */
            $path_name = false; 

            //If the user entered only spaces or nothing at all in the psychopathology name for field, thrown an exception
            throw new Exception("<strong>Psychopathology name field was left empty; NO DATA ENTERED.</strong>");
        }
        /* If the user has entered something into the form field, it is time to start checking that the name has not already
           been put into the database column path_name */
        else {

            // here I am using mysqli function that helps prevent mysqli injection attacks but putting in / 
            $path_name = mysqli_real_escape_string($db_connection,$_POST['path_name']);

            /* here I am seeting the variable pathology_ecists with the default value of false. I am using this value below when
               checking in the psychopathology already exists in the database and if it is, I will be changing it to true. The true
               comes in the condition later on }elseif{$pathology_exists == false... then the pathology is entered into the database.
               However, if the pathology_exists is true, then the condition where the pathology is entered into the database is skipped.*/
            $pathology_exists = false;

            //THIS WILL GET ALL OF THE CURRENT PATHOLOGY NAMES FROM THE DATABASE AND COMPARE THEM TO WHAT USER ENTERED IN FORM FIELD
            //the mysql code saying I want to SELECT the column PATH_NAME FROM the PATHOLOGY table.
            $check_names = "SELECT path_name FROM pathology";

            // Here I am making the query to the database with mysql connection I created earlier the mysql code
            $request_names = mysqli_query($db_connection, $check_names);

            /* The results from above (if there is any) will be FETCHED from what was returned above and it is put into a 
               standard php associative array */
            $get_names = mysqli_fetch_all($request_names, MYSQLI_ASSOC);

            //looping over eavery subarray in the main array above
            foreach($get_names as $path){

                /*Making sure I am only targeting the 'path_name'. Even though I said above in the query SELECT path_name, in an associative
                  array I need to make sure I use the KEY. IF it is true that the pathology name is in the database on iteration and it is the
                  same as string the user entered, then execute the code. */
                if(strval($path['path_name']) == strval($path_name)){
                    echo htmlspecialchars($path_name . " already exists in the psychopathology database. NO DATA ENTERED.");

                    /* I am changing the variable $pathology_exists to TRUE because that way the code later on that
                    $pathology_exists == false won't execute because now the value is true */
                    $pathology_exists = true;
                    break;
                /* I am just using an else here to make sure the variable is false so the data will be entered into 
                   the mysql database */
                }else{
                    $pathology_exists = false;
                }
                }
                }

        /* IF it is true that the path_symptoms variable where the user entered into the html form fiels is empty
         and the pathology does not already exist in the database, execute this code */
        if (empty($path_symptoms) && $pathology_exists == false) {
            $path_symptoms = 'No symptoms entered';
            $path_symptoms = mysqli_real_escape_string($db_connection, $path_symptoms);
            
            // showing the user that the symptoms weren't entered (but it is allowered)
            echo htmlspecialchars("No symptoms entered. ");
        }
        /* IF it is true that the path_description variable where the user entered into the html form field is empty
         and the pathology does not already exist in the database, execute this code */
        if (empty($path_description) && $pathology_exists == false){
            $path_description = 'No description entered';
            $path_description = mysqli_real_escape_string($db_connection, $path_description);

            // showing the user that no description was entered (but it is alloweed).
            echo " No desciption entered. ";
        }
    }
    /* must catch the exception, and the exception I am catching in this instance is the one where the user enters no
    information into the html psychopathology name field */
    catch (Exception $err){
        echo $err->getMessage();
}
//---------------------------------------------- 
//      add to MYSQL (only if $path_name was not set to false). This is because I want it to be alowed that the
//      symptoms and/or description can be left empty.
        if($path_name == false){
            null;
        
        //OTHERWISE, if it is TRUE that $pathology_exists variable is equal to BOOL false, then execute this code.
        
        }elseif($pathology_exists == false){
        /* the mysql code that says I want to INSERT INTO the PATHOLOGY table in columns (PATH_NAME, PATH_SYMPTOMS
            PATH_DESCRIPTION) and the VALUES that i want to insert into them at my variables $path_name(which will be
            entered into PATH_NAME column), PATH_SYMTPOMS (which is entered into the path symptoms columns), and 
            PATH_DESCRIPTION (which is inserted into the path_description column) */
        $construct_query = "INSERT INTO pathology(path_name,path_symptoms,path_description)
                            VALUES('$path_name','$path_symptoms','$path_description')";

        /* I am sending the mysql code above to the mysql database and entering it in because the mysql code above is
        actually for entering in data (earlier I retrieved data) */
        $execute_query = mysqli_query($db_connection, $construct_query);

        //displaying to the user that the data was entered
        echo htmlspecialchars("DATA ENTERED INTO THE DATABASE.");
        mysqli_close($db_connection);
        }else{
            null;
        }
?>

<!-- site map for easier navigation -->
<?php include "../settings/sitemap.html" ?>

</div>
