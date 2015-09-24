<?php
/*
	This is a landing page for the user.
	Multiple "view" pages can be added and linked to
	here for easy navigation if you have mmultiple 
	tables to check or monitor.
 */

# Start PHP session so we can be sure the user is logged in  
session_start();

# Check to see if the user is logged in or not
if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'True')) {
	# If the user is not logged in, send them to the login page rather than loading this page
	header ("Location: login.php");
}

?>

<html>
<head>
	<title>Landing Page Title!</title>
</head>
<body>
<p>Welcome, Admin! Choose an option below to view stats.</p>
<a href="view.php"><button type="button">View Top Scores</button></a>
<a href="view2.php"><button type="button">View Page 2</button></a>
<a href="view3.php"><button type="button">View Page 3</button></a>
<a href="view4.php"><button type="button">View Page 4</button></a>
<a href="view5.php"><button type="button">View Page 5</button></a>
</body>
</html>