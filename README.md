# My Tools - PHP
*Author: Chad Antonson

*Contact: chad@antonsons.com

*Version: 1.0

Throwing some scripts together for future use

Current Tools:
* EzBackup.php - Set a cron job to call this script to back-up your SQL database
* LiveAdAllocation/ - Client and Server example of how to change ad allocations live w/o updating app
 * client/
  * adSettings.cs - Example of how to access the server JSON file and re-order ads
  * SimpleJSON.cs - JSON parsing script from here: http://wiki.unity3d.com/index.php/SimpleJSON
 * server/
  * index.php - Landing Page...allows you to change the order that ads are called in the app
  * login.php - Used to enter credentials in order to access main page
  * look.css - CSS for index
  * theJSON.json - The json file that is updated by index and requested from the app at load
* ViewDatabaseStats/ - Example of how to check your app's stats/users/events
 * connectDB.php - PDO database connection
 * index.php - Landing page...will send you to login.php if you are not logged in
 * login.php - Used to enter credentials in order to access main page
 * view.php - Uses the PDO connection to query a table and display the results in an HTML table
