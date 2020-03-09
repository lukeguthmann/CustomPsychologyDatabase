<!-- This is the page that returns the description for a psychopathology that already exists
     in the database. If it does not exist, then it prompts users -->
     <div class='div_background'>

<!-- connection information for the database -->
<?php include "../database/database-connection.php" ?>

<!-- connection to the database -->
<? $db_connection = databaseConnection(); ?>

<!-- connection information for the database -->
<?php include "../settings/header.html" ?>

<!-- css stylesheet -->
<link rel="stylesheet" href="../settings/stylesheet.css">

<form action="display_psychopathology.php" method="post">
    <input  type='text' name='path_search' placeholder="search for psychopathology" style="size:100"></input>
    <br>
    <br>

    <input type="submit" name="submit" value='submit'></input>
</form>
<?php

$mysql_query = "SELECT path_name FROM pathology";
$make_query = mysqli_query($db_connection, $mysql_query);
$mysql_results = mysqli_fetch_all($make_query, MYSQLI_ASSOC);

//printing out results
echo "<h3>Current psychopathology's in database</h3>";
foreach($mysql_results as $result){
    echo htmlspecialchars($result['path_name']);
    echo "<br>";
}
?>

<?php include "../settings/sitemap.html" ?>

</div>
