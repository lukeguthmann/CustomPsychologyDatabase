<!-- SANTISING USER DATA .. helps to remove illegal chaarcters FROM INPUT that can cause webpage to be hacked 
FILTER_VAR() function is used for sanitsation and validation-->
<!-- this is the path to the directroy where my header.html file is from root-->
<link rel="stylesheet" type='text/css' href="../settings/stylesheet.css" />

<?php include '../settings/header.html' ?>


<!-- want to have pathology name, symptoms, definition and then a way to search the database-->
<div class='div_background'>
<form action="retrieved_pathology.php" method="post">
    <div style="font-size:20px; font-weight:bold"> PSYCHOPATHOLOGY: </div>
    <input style="size:100" type='text' name='path_name' placeholder="psychopathology"></input>
    <br>
    <br>

    <div style="font-size:20px; font-weight:bold"> SYMPTOMS: </div>
    <input type='text' name='path_symptoms' placeholder='symptoms'></input>
    <br>
    <br>
    <div style="font-size:20px; font-weight:bold"> CONDITION DESCRIPTION: </div>
    <textarea class='description_text' name='path_description' cols='30' rows='40' placeholder='enter description'></textarea>
    <br>
    <input type="submit" name="submit" value='submit'></input>
</form>
</div>

<!-- this is the path to the directroy where my footer.html file is from root-->
