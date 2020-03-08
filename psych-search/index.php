<!-- SANTISING USER DATA .. helps to remove illegal chaarcters FROM INPUT that can cause webpage to be hacked 
FILTER_VAR() function is used for sanitsation and validation-->

<!-- this is the path to the directroy where my header.html file is from root-->
<?php include "../settings/header.html" ?>

<!-- css stylesheet -->
<link rel="stylesheet" href="../settings/stylesheet.css">

<!-- want to have pathology name, symptoms, definition and then a way to search the database-->
<div class='div_background'>
<form action="display_psychopathology.php" method="post">
    <input  type='text' name='path_search' placeholder="search for psychopathology" style="size:100"></input>
    <br>
    <br>

    <input type="submit" name="submit" value='submit'></input>
</form>
<?php
$db_connection = mysqli_connect('localhost', 'shaun', 'root', 'psychopathology');
$mysql_query = "SELECT path_name FROM pathology";
$make_query = mysqli_query($db_connection, $mysql_query);
$mysql_results = mysqli_fetch_all($make_query, MYSQLI_ASSOC);

//printing out results
echo "<h3>Current psychopathologies in database</h3>";
foreach($mysql_results as $result){
    echo htmlspecialchars($result['path_name']);
    echo "<br>";
}
?>
</div>
