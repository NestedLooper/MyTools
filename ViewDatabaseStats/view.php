<?php
# Start PHP session so we can be sure the user is logged in 
session_start();

# Check to see if the user is logged in or not
if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'True')) {
	# If the user is not logged in, send them to the login page rather than loading this page
	header ("Location: login.php");
}

# include the Database Connection script
include 'connectDB.php';

# Be sure to change tablename to the name of the DB table you wish to query
$stmt = $dbh->prepare("SELECT * FROM tablename ORDER BY score DESC");
$stmt->execute();

# Store all results in an object, $result.
# We will loop through this and create an HTML table from the data below in the HTML
$result = $stmt->fetchAll();

# End PHP, start HTML
 ?>

 <html>
 <head>
 	<title>The title of my page!</title>
 </head>
 <body>
 	<a href="index.php">Back</a>
	<table border="1" style="width:100%">
	 	<caption>Today's Submissions:</caption>
	 	<thead>
	 		<tr>
	 			<th>Image</th>
	 			<th>Name</th>
	 			<th>Score</th>
	 		</tr>
	 	</thead>
	 	<tbody>
	 		
	 		<?
	 			# For each result from the database query, create a new row in the HTML table
	 			foreach ($result as $row) {
	 				# Start new row
		 			echo '<tr>';
		 			# Add the img url as an actual image, 50px x 50px
		 			echo '<td><img src=' . $row['playerID'] . '.png height="50" width="50""/></td>';
		 			# Add the information from the other 2 columns
		 			echo '<td>' . $row['name'] . '</td>';
		 			echo '<td>' . $row['score'] . '</td>';
		 			# End this row
		 			echo '</tr>';
	 			}
	 		?>
	 	</tbody>
	 </table> 
 </body>
 </html>