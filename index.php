<?php

require_once 'vendor/autoload.php';

use App\Person;
use App\Registry;

var_dump($_POST);
$personalRegistry = new Registry('peopleRegistry.csv');

if (isset($_POST['fname'])) {
    $newPerson = new Person($_POST['fname'], $_POST['lname'], $_POST['id'], $_POST['descr'], '/home/arthur/PhpstormProjects/PHPbasics/peopledata/peopleRegistry.csv');
}

?>

<!DOCTYPE html>
<html lang="en">
<body>

<h2>Add PERSON:</h2>

<form method="post">
    <label for="fname"></label><br>
    <input type="text" id="fname" name="fname" placeholder="First name"><br>
    <label for="lname"></label><br>
    <input type="text" id="lname" name="lname" placeholder="Last name"><br>
    <label for="id"></label><br>
    <input type="text" id="id" name="id" placeholder="Person ID (123456-12345)"><br>
    <label for="descr"></label><br>
    <textarea typeof="text" id="descr" name="descr" rows="4" cols="40" placeholder="Description"></textarea>
    <input type="submit" value="Submit">
</form>

<h2>Search PERSON:</h2>

<form method="get">
    <label for="id" ></label><br>
    <input type="text" id="id" name="id" placeholder="Person ID (123456-12345)"><br>
    <input type="submit" value="Submit">
</form>

<?php
if (isset($_GET['id'])) {

    $searchedPerson = $personalRegistry->search($_GET['id']);
    echo "Name: {$searchedPerson[0]}, surname: {$searchedPerson[1]}, ID: {$searchedPerson[2]}, Description: {$searchedPerson[3]}";
}    ?>


<input type="button" value="Delete" onclick="<?php $personalRegistry->delete(); ?>">


</body>
</html>