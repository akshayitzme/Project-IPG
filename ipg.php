<?php
$ip = $_SERVER['REMOTE_ADDR']; //IP VARIABLE
($details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"))) or die("Cant Access ipinfo.io <br> Check Internet Connection"); // TO FIND IP DATAS (JSON)
$ip = $details->ip;
$country = $details->country;
$city = $details->city;
$region = $details->region;
$host = $details->hostname;
$uag = $_SERVER['HTTP_USER_AGENT']; // USER AGENT VARIABLE

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

($query = mysqli_query($dbconnect, "INSERT INTO `TABLE-NAME` (`id`, `IP`, `Country`, `City`, `Region`, `Host`, `UAG`) VALUES (NULL, '$ip', '$country', '$city', '$region', '$host', '$uag') ")) or die("Error Inserting Data");

/* UNCOMMENT TO ENABLE FILE WRITING

$filename=""; //FILENAME
$myfile= fopen($filename,"a");
fwrite($myfile, "\n");
fwrite($myfile, $ip." ");
fwrite($myfile, $country." ");
fwrite($myfile, $city." ");
fwrite($myfile, $region." ");
fwrite($myfile, $host." ");
fwrite($myfile, $uag." ");
fclose($myfile);
 */

?>
