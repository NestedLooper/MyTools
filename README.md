# My Tools - PHP
*Author: Chad Antonson

*Contact: chad@antonsons.com

*Version: 1.0

Throwing some scripts together for future use

Current Tools:
* EzBackup.php - Set a cron job to call this script to back-up your SQL database
* ViewDatabaseStats/
 ** connectDB.php - PDO database connection
 ** index.php - Landing page...will send you to login.php if you are not logged in
 ** login.php - Script/Page used to enter credentials in order to access other pages
 ** view.php - Uses the PDO connection to query a table and display the results in an HTML table