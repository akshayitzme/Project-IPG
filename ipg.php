<?php
$ip = $_SERVER['REMOTE_ADDR']; //IP VARIABLE
($details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"))) or die("Cant Access ipinfo.io <br> Check Internet Connection"); // TO FIND IP DATAS (JSON)
$ip = $details->ip;
$country = $details->country;
$city = $details->city;
$region = $details->region;
$host = $details->hostname;
$uag = $_SERVER['HTTP_USER_AGENT']; // USER AGENT VARIABLE
$isp = $details->org;
$postal = $details->postal;
$tz = $details->timzone;
$loc = $details->loc;
$date = date("Y-m-d H:i:s"); //DATE VARIABLE

/* ------- SQL SERVER ----- */

$hostname = ""; //SERVER HOSTNAME
$username = ""; //SQL USERNAME
$password = ""; //SQL PASSWORD
$db = ""; //DATABASE

/* ------- CHECK DB CONNECTION ------*/

($dbconnect = mysqli_connect($hostname, $username, $password, $db)) or die("Unable to Connect DB");

if ($dbconnect->connect_error) {
    die("Database connection failed: " . $dbconnect->connect_error);
}

/* ---------- INSERT QUERY ---------- */

($query = mysqli_query($dbconnect, "INSERT INTO `datas` (`id`, `Date`, `IP`, `Country`, `City`, `Region`, `Location`, `Host`, `ISP`, `UAG`) VALUES (NULL, '$date', '$ip', '$country', '$city', '$region', '$loc', '$host', '$isp', '$uag')")) or
    die("Error Retrieving Data");

/* UNCOMMENT TO ENABLE FILE WRITING

$filename=""; //FILENAME
$myfile= fopen($filename,"a");
fwrite($myfile, "\n");
fwrite($myfile, $date." ");
fwrite($myfile, $ip." ");
fwrite($myfile, $country." ");
fwrite($myfile, $city." ");
fwrite($myfile, $region." ");
fwrite($myfile, $host." ");
fwrite($myfile, $uag." ");
fwrite($myfile, $isp." ");
fwrite($myfile, $postal." ");
fwrite($myfile, $tz." ");
fwrite($myfile, $loc." ");
fclose($myfile);
 */

?>
