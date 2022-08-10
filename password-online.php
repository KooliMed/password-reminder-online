<?php
# Password-online v1.0.1
# https://github.com/KooliMed/password-online/
# Please do not delete any of the above lines

session_start();
// Unique key. You MUST change this to your own key.
$key = 'YourKeyHere'; //No Space, should be at least 5 letters and 1 number (no need to remember it)
$timezone = 'Europe/Amsterdam';
$api_key = 'ayahhsggetjkksoo2541sd4d55d22d58ee'; // Get your key from https://www.abstractapi.com/api/time-date-timezone-api

# It's important to notice that we need to output the less message on this page, whatever error or information we could probably show to the user.
// Get the true time, regardless of the configuration of the server or php
function GetTime($api_key,$timezone){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://timezone.abstractapi.com/v1/current_time/?api_key='.$api_key.'&location='.$timezone);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$output = curl_exec($ch);
	curl_close($ch);
	
	$date = json_decode($output) -> datetime;
	$secret_code=(substr($date,11,1)+9);
	$secret_code.=(substr($date,12,1)+7);
	$secret_code.=(substr($date,14,1)+5);
	$secret_code.=(substr($date,15,1)+3);
	return 	$secret_code;
}


// Simple way to put a limit to session for 15mn and reseting the whole process.
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    session_unset();  
    session_destroy();
	echo 'Data unset..<br>'; // You should comment this line
}

// If no session exist, we verify that the access to this page is made by someone who knows how this page works.
if(!isset($_SESSION['secret'])){
	// The secret word is not sent or empty, so we just exit; usuful for anything like robots, google..etc
	if(empty($_GET['secret']) || !isset($_GET['secret'])){
		echo 'No Secret'; // You should comment this line
		exit;
	} 
	$secret_code = GetTime($api_key,$timezone);; // Get the true time
	
	// Check the secret word is the actual one, elsewhere we just exit; usuful for anything like robots, google..etc
	if($_GET['secret'] != $secret_code){
		echo 'Invalid Secret'; // You should comment this line
		exit;
	} 
	
	$_SESSION['secret'] = $secret_code; // The secret sent is valide; We record that and grant the user access for 15mn in case he needs to access this page more than one time.
	echo 'Session recorded <br>'; // You should comment this line
	if(isset($_GET['target']) && !empty($_GET['target'])){
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	echo substr(base64_encode(hash('sha256', $_GET['target'].$key)),5,8);	
	}
}else{

	echo 'Access already granted. Processing...<br>'; // You should comment this line
	if(isset($_GET['target']) && !empty($_GET['target'])){
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	echo substr(base64_encode(hash('sha256', $_GET['target'].$key)),5,8);	
	}
}
?>
<meta http-equiv="refresh" content="120;url=<?php echo preg_replace("/\?.*$/","",$_SERVER["REQUEST_URI"]); ?>">
