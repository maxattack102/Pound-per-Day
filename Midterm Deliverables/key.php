<?php
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/frontend/logging/log.txt'); 

if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
 	header("location: login.php"); 
  }

$term = $_POST["term"];
$radius = $_POST["mile"];
$location = $_POST["location"];
$categories = $_POST["categories"];


$curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.yelp.com/v3/businesses/search?term=$term&location=$location&radius=$radius&categories=$catgories",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer AaSchxgW6CevWliC49M-WXAvN2qSeN5TI1UamKeg3y4SkIuqU5iOHIViAWYxzYob4CpB0KVsgogWasiHgEcv4RVRAvXbhrl-P3PhGvy1dXvQ2P3dFOqj43IQb76SXHYx",
    "Postman-Token: 4175c3c0-d394-4762-81c8-0b62b45c8aa4",
    "cache-control: no-cache"
  ),
));

/*echo "<pre>";
echo curl_exec($curl);
echo "</pre>";*/

$response = curl_exec($curl);
$err = curl_error($curl);


curl_close($curl);


if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}


  
$fp = fopen ( $url , "r" ); 
$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {      $contents .=  $more ;   }
echo $contents ; 


$json= json_decode($response); //prints out the array in a neat format
//print_r($json); or var_dump($json) = prints the entire data after being formatted




//echo $json->businesses[0]->url;






echo $json->total;
$total = $json->total;;


echo "<br>";


for ($x = 0; $x < $total; $x++) {
    echo "<br>";
    echo "<br>";
    echo $json->businesses[$x]->name;
    echo "<br>";
    echo "<br>";
    echo "Rating: ";
    echo $json->businesses[$x]->rating;
    echo "<br>";
    echo "<br>";
    echo $json->businesses[$x]->location->address1;
    echo " ";
    echo $json->businesses[$x]->location->city;
    echo ", ";
    echo $json->businesses[$x]->location->state;
    echo " ";
    echo $json->businesses[$x]->location->zip_code;
    echo "<br>";
    echo "<br>";
    $image = $json->businesses[$x]->image_url;
    $imageData = base64_encode(file_get_contents($image));
    echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
} 

?>
