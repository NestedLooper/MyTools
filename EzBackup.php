<?php

/*
*
* @author  Chad Antonson
* @date    9-15-15
* @name    EzBackup.php
* @use:
* 1) Insert connection info for your database.
* 2) Set up a cron to run as often as you will need backups 
* 3) Creates backups of the SQL DB in the backups directory(named backup_'datetime'.sql)
* 4) Cleans up the directory, keeping only the number of backups you want
* 5) Sends you an email if there are any issues with the backup
*/

# Enter contact email in case of backup failure:
define($email, "you@domain.com");

# Enter db connection information here:
define($dbUser, "");
define($dbPassword, "");
define($dbName, "");

# By default, saves backups to a directory named "backup"
# Enter the name of the directory you'd like to save these in:
define($dir, "backups");

# By default, saves 30 backups at a time(i.e 15 days worth if called twice daily)
# Enter the total number of backups you'd like to keep in the directory at a time.
define($total, 30);

# Create a backup of the db and add timestamp to name
try{
	# Create directory if it doesn't exist yet
	if (!file_exists($dir)) {
    	mkdir($dir, 0777, true);
	}
	$today = date("Y-m-d_H:i:s");
	$saveName = $dbName . '_backup_' . $today . '.sql';
	$file = $dir . "/" . $saveName; 
	$BU = shell_exec( "mysqldump --allow-keywords --opt -u$dbUser -p$dbPassword $dbName > $file 2>&1");
}catch(Exception $e){
	#Send me an email if backup doesn't work for any reason
	$msg = 'Caught exception: ' .  $e->getMessage();
	mail($email, "Error with EzBackup" . $msg);
}

# Clean up the directory by removing oldest backups
$files = glob($dir . "/" . '*.sql');
usort($files, create_function('$a,$b', 'return filemtime($a)<filemtime($b);'));
while (count($files) > $total){
	$oldest = array_pop($files);
	unlink($oldest);
}	

?>