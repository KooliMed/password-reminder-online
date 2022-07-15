# password-online
This project was made, just because of the need to the fastest secure online password reminder.<p>
How to securely store all of your passwords with no need to really record them anywhere?<br>
How to access to all your passwords from anywhere in the world?<br>
How to access to all your passwords with no need for a sign in and a huge pages to visit to get them all?<br>
How to access to all your passwords with just an URL?<br>
This script saves you a lot of time and brainstorming.
<p> 
Installation:<br>
Just put it anywhere on a server.<br>
You can rename it to anything you like.
<p>  
Configuration:<br>
Change these 2 parameters with your own ones <br>
$key = 'MyKey12'; // Your own unique key <br>
$timezone = 'America/New York'; The timezone you use. For the list of available zones, https://www.php.net/manual/en/timezones.php<br>
$api_key = ''; // Get your own key from https://www.abstractapi.com/api/time-date-timezone-api (5000 requests per month)
<p>  
Usage:<br>
https://www.example.com/password-online.php?secret=[timezone]&target=[target]
<p> 
Let's get the password for github.com!<br>
We need to add 2 variables to our script url, which we already uploaded let's say @ https://www.example.com/password-online.php<br>
    secret: a special variable which is a combination of the actual timezone you choose (24h format) and the 9,7,5,3 numbers (9753 is the only number you must memorize)<br>
    target: the target can be, a mail address, a login page url, a software name, anything else..
<p> 
Example: timezone = 12:20 -> we split that on numbers so we will have 1,2,2,0<br>
Just add 9 to 1, 7 to 2, 5 to 2, 3 to 0<br>
We will get the secret=10973 
<p> 
Syntaxe:<br>
https://www.example.com/password-online.php?secret=10973&target=github.com<br>
You will get an 8 uppercase and lowercase letters with 1-3 numbers password combination.
<p> 
The script will automatically end the session each 15mn.<br>
It will also redirect the page each 120 seconds to the url, and will then hide the password generated, the secret word and the target, to protect your password if ever you forget the page open on your browser or your mobile.<br> 
