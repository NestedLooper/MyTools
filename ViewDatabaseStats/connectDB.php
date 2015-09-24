<?php 
/*
This script connects to the database.
Include it in your other scripts that require a db connection.
*/

# Set your name, username, and password for your database
define($dbname, "");
define($user, "");  
define($password, "");
 
# Try to connect to the database
try {
 $dbh = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", $user, $pass);
 $dbh -> exec('SET NAMES utf8');
}catch(PDOException $error){
 # If there is an error connecting, print the error and kill the page
 print "Error!: " . $error->getMessage() . "<br/>";
 die();
}

 ?>