<?php 
# Chad Antonson - Ad Allocation Station
# This is a web tool for setting ad allocation in your Unity apps
# The current options are Unity Ads, AdColony, Chartboost, and MoPub
# This can easily be modified to add or remove networks to work with your app.
# The changes are saved to txt files for easy/fast access from Unity apps.
# Please see the 'local' directory for an example of how to pull results in C#.

# Start the PHP Session
session_start();
# Make sure user has logged in, if not, redirect to login page
if(!isset($_SESSION["loggedIn"])){
	header('Location: login.php');
}

# Get content of json file and make an array so we can edit
$theJSON = file_get_contents('theJSON.json');
$data = json_decode($theJSON, true);

# Grab the current settings for iOS Interstitials, Video Ads, and Click Counts
$crtCount_ios = $data["iOS"]['Count'];
$intOrder_ios = $data["iOS"]['Int_Order'];
$videoOrder_ios = $data["iOS"]['Vid_Order'];

# Grab the current setting for Android Interstitials, Video Ads, and Click Counts
$crtCount_android = $data["Android"]['Count'];
$intOrder_android = $data["Android"]['Int_Order'];
$videoOrder_android = $data["Android"]['Vid_Order'];

# Create an array from each ordered list for easy access
$ints = array();
$ints = explode(',', $intOrder_ios);
$vidz = array();
$vidz = explode(',', $videoOrder_ios);
$ints_android = array();
$ints_android = explode(',', $intOrder_android);
$vidz_android = array();
$vidz_android = explode(',', $videoOrder_android);

# If the user just submitted changes, let's update the JSON as needed
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	# User wants to change the number of iOS Clicks
	if(isset($_POST['UpdateCount_ios'])){
		if( isset($_POST['uc']) && $_POST['uc']!= '') {
			# Get the number to use
			$newCount = $_POST['uc'];
			# Update JSON object with new Count
			$data["iOS"]['Count'] = $newCount;
			# Re-encode the json object
			$newJsonString = json_encode($data);
			# Update our json with the latest change
			file_put_contents('theJSON.json', $newJsonString);
			# Reload page to reflect update
			Header('Location: '. $_SERVER['PHP_SELF']);
		}
	}

	# User wants to change the order of iOS Interstitials
	if(isset($_POST['UpdateInts_ios'])){
		if( isset($_POST['i1']) && isset($_POST['i2']) && isset($_POST['i3']) && isset($_POST['i4'])) {
			# Get the new Interstital order and update the JSON file
			$i1 = $_POST['i1'];
			$i2 = $_POST['i2'];
			$i3 = $_POST['i3'];
			$i4 = $_POST['i4'];
			$ints = $i1 . ',' . $i2 . ',' . $i3 . ',' . $i4;
			$data["iOS"]['Int_Order'] = $ints;
			# Re-encode the json object
			$newJsonString = json_encode($data);
			# Update our json with the latest change
			file_put_contents('theJSON.json', $newJsonString);
			# Reload page to reflect update
			Header('Location: '. $_SERVER['PHP_SELF']);
		}
	}
	# User wants to change the order of iOS Video Ads
	if(isset($_POST['UpdateVids_ios'])){
		if( isset($_POST['v1']) && isset($_POST['v2']) && isset($_POST['v3']) && isset($_POST['v4']) ) {
			# Get the new Video Ad order and update the JSON file
			$v1 = $_POST['v1'];
			$v2 = $_POST['v2'];
			$v3 = $_POST['v3'];
			$v4 = $_POST['v4'];
			$vids = $v1 . ',' . $v2 . ',' . $v3 . ',' . $v4;
			$data["iOS"]['Vid_Order'] = $vids;
			# Re-encode the json object
			$newJsonString = json_encode($data);
			# Update our json with the latest change
			file_put_contents('theJSON.json', $newJsonString);
			# Reload page to reflect update
			Header('Location: '. $_SERVER['PHP_SELF']);
		}
	}
	
	# User wants to change the number of Android Clicks
	if(isset($_POST['UpdateCount_android'])){
		if( isset($_POST['uca']) && $_POST['uca']!= '') {
			# Get the number to use
			$newCounta = $_POST['uca'];
			# Update JSON object with new Count
			$data["Android"]['Count'] = $newCounta;
			# Re-encode the json object
			$newJsonString = json_encode($data);
			# Update our json with the latest change
			file_put_contents('theJSON.json', $newJsonString);
			# Reload page to reflect update
			Header('Location: '. $_SERVER['PHP_SELF']);
		}
	}

	# User wants to change the order of Android Interstitials
	if(isset($_POST['UpdateInts_android'])){
		if( isset($_POST['i1a']) && isset($_POST['i2a']) && isset($_POST['i3a']) && isset($_POST['i4a'])) {
			# Get the new Interstital order and update the JSON file
			$i1a = $_POST['i1a'];
			$i2a = $_POST['i2a'];
			$i3a = $_POST['i3a'];
			$i4a = $_POST['i4a'];
			$ints = $i1a . ',' . $i2a . ',' . $i3a . ',' . $i4a;
			$data["Android"]['Int_Order'] = $ints;
			# Re-encode the json object
			$newJsonString = json_encode($data);
			# Update our json with the latest change
			file_put_contents('theJSON.json', $newJsonString);
			# Reload page to reflect update
			Header('Location: '. $_SERVER['PHP_SELF']);
		}
	}
	# User wants to change the order of Android Video Ads
	if(isset($_POST['UpdateVids_android'])){
		if( isset($_POST['v1a']) && isset($_POST['v2a']) && isset($_POST['v3a']) && isset($_POST['v4a']) ) {
			$v1a = $_POST['v1a'];
			$v2a = $_POST['v2a'];
			$v3a = $_POST['v3a'];
			$v4a = $_POST['v4a'];
			$vids = $v1a . ',' . $v2a . ',' . $v3a . ',' . $v4a;
			$data["Android"]['Vid_Order'] = $vids;
			# Re-encode the json object
			$newJsonString = json_encode($data);
			# Update our json with the latest change
			file_put_contents('theJSON.json', $newJsonString);
			# Reload page to reflect update
			Header('Location: '. $_SERVER['PHP_SELF']);
		}
	}
}

?>

 <html>
 <head>
 	<title>Ad Order</title>
 	<link href="look.css" rel="stylesheet" type="text/css" />
 </head>
 <body class="lookatit">
<center>
	<h1><u><b>My App's Ads - Allocation Station</b></u></h1>
 	<div id="ios" class="aBox">
 	<form method=post action="index.php">
 		<h2>iOS Settings</h2>
 		Set <b>iOS Interstitial</b> ad allocation order:<br>
 		<br>
 		1) <select name="i1">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints[0] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints[0] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints[0] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints[0] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		2) <select name="i2">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints[1] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints[1] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints[1] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints[1] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		3) <select name="i3">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints[2] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints[2] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints[2] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints[2] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		4) <select name="i4">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints[3] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints[3] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints[3] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints[3] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
		<input type="hidden" name="UpdateInts_ios" />
		<br>
		<input type="submit" value="Update Interstitial Order" />  
	</form><br><br>
	<form method=post action="index.php">
		Enter the <b>iOS Video</b> ad providers in the order you want.<br>
		<br>
 		1) <select name="v1">
 			<option value="-">-</option>
 			<option value="adcolony"<? if($vidz[0] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz[0] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz[0] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz[0] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		2) <select name="v2">
 			<option value="-">-</option>
 			<option value="adcolony"<? if($vidz[1] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz[1] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz[1] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz[1] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		3) <select name="v3">
 			<option value="-">-</option>
 			<option value="adcolony"<? if($vidz[2] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz[2] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz[2] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz[2] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		4) <select name="v4">
 			<option value="-">-</option>
 			<option value="adcolony"<? if($vidz[3] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz[3] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz[3] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz[3] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
		<input type="hidden" name="UpdateVids_ios" />
		<br>
		<input type="submit" value="Update Video Order" /> 
	</form>

	<form method=post action="index.php">
		Enter the <b>iOS Interstitial Count</b>  you want.<br>
		<input type="text" name="uc" size="3px" value="<?echo $crtCount_ios;?>"/><br>
		<input type="hidden" name="UpdateCount_ios" />
		<br>
		<input type="submit" value="Update Count" />
	</form>
	</div>

	<div id="android" class="aBox">
	<form method=post action="index.php">
		<h2>Android Settings</h2>
 		Set <b>Android Interstitial</b> ad allocation order:<br>
 		<br>
 		1) <select name="i1a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints_android[0] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints_android[0] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints_android[0] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints_android[0] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		2) <select name="i2a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints_android[1] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints_android[1] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints_android[1] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints_android[1] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		3) <select name="i3a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints_android[2] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints_android[2] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints_android[2] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints_android[2] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		4) <select name="i4a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($ints_android[3] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($ints_android[3] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($ints_android[3] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($ints_android[3] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
		<input type="hidden" name="UpdateInts_android" />
		<br>
		<input type="submit" value="Update Interstitial Order" />  
	</form><br><br>
	<form method=post action="index.php">
		Enter the <b>Android Video</b> ad providers in the order you want.<br>
		<br>
 		1) <select name="v1a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($vidz_android[0] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz_android[0] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz_android[0] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz_android[0] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		2) <select name="v2a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($vidz_android[1] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz_android[1] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz_android[1] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz_android[1] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		3) <select name="v3a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($vidz_android[2] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz_android[2] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz_android[2] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz_android[2] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
 		4) <select name="v4a">
 		<option value="-">-</option>
 			<option value="adcolony"<? if($vidz_android[3] == "adcolony") echo ' selected ' ?>>AdColony</option>
 			<option value="chartboost" <? if($vidz_android[3] == "chartboost") echo ' selected ' ?>>Chartboost</option>
			<option value="mopub" <? if($vidz_android[3] == "mopub") echo ' selected ' ?>>Mopub</option>
 			<option value="unity" <? if($vidz_android[3] == "unity") echo ' selected ' ?>>Unity Ads</option>
 		</select>
 		<br>
		<input type="hidden" name="UpdateVids_android" />
		<br>
		<input type="submit" value="Update Video Order" /> 
	</form>

	<form method=post action="index.php">
		Enter the <b>Android Interstitial Count</b>  you want.<br>
		<input type="text" name="uca" size="3px" value="<?echo $crtCount_android;?>"/><br>
		<input type="hidden" name="UpdateCount_android" />
		<br>
		<input type="submit" value="Update Count" />
	</form>
	</div>
</center>	
 </body>
 </html>