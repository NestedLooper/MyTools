<?php
# Start the PHP Session
session_start();
# Set loggedIn to false. I added this so if you decide to add a logout
# button anywhere, it can simply redirect here and log them out 
$_SESSION['loggedIn'] = False;

# Set the password for your site here
define("password", "");

# Check if the user just tried submitting a password
if (isset($_POST['submitted']))  {

  # Set the submitted password to a variable
  $pwsub = $_POST['pass'];
  
  # Check to see if the password is correct
  if ($pwsub != password){
    # Incorrect - Tell user
    echo("Incorrect Password");
  }else{
    # Correct password - Set loggedIn to true and Redirect to index page
    $_SESSION['loggedIn'] = True;
    header( 'Location: index.php' ) ;
  }
}

?>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <div class="passform">
    <form id="pwform" method="post" action="">
    <input type="hidden" name="submitted" value="pwsubmitted" />
      <center>
        <span>Are you the Admin? Prove it. Enter your password!</span><br>
        <input name="pass" id="pass" type="password" class="password"  />
        <input name="submit" type="submit" class="submit" style="cursor: pointer;" value="Go" /></div>
    </center>
    </form>
  </div>
</body>
</html>