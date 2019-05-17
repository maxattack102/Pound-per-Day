<?php

//Requried files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');
//require_once('rabbitMQClient.php');
    
//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/database/logging/log.txt');

//Restaurant Reccomendation
function doYelp($username, $term, $location, $mile)
{   

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
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
 		echo "cURL Error #:" . $err;
	}
	else {
	}

	$json= json_decode($response); 
	$total = $json->total;
	echo "<br>";

	$result = "";
	$result .= "<br>";
	
	for ($x = 0; $x < $total; $x++) {
		$result .= "<br>";
		$result .= "<br>";
		$result .= "<br>";
		$result .= $json->businesses[$x]->name;
		$result .= "<br>";
		$result .= "Rating: ";
		$result .= $json->businesses[$x]->rating;
		$result .= "<br>";
		$result .= $json->businesses[$x]->location->address1;
		$result .= " ";
		$result .= $json->businesses[$x]->location->city;
		$result .= ", ";
		$result .= $json->businesses[$x]->location->state;
		$result .= " ";
		$result .= $json->businesses[$x]->location->zip_code;
		$result .= "<br>";
		$image = $json->businesses[$x]->image_url;
		$imageData = base64_encode(file_get_contents($image));
		$result .= '<img src="data:image/jpeg;base64,'.$imageData.'" width="128" height="128">';
	} 

	//$all_info = array('data'=>$data);
	echo "\n\n\t***Show Reccomendations***\n\n";
	return json_encode($result);
}
//Date
function doDate($username, $search, $cuisine, $diet, $restrictions, $type, $calories, $location, $mile)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?query=$search&cuisine=$cuisine&excludeIngredients=$restriction&type=$meal&minCalories=0&maxCalories=$calories&limitLicense=false&offset=0&number=100",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			"X-RapidAPI-Key: e15d210dd7mshd26dc31e4212daep1fb5d2jsnb33fb9faa4f2"
		),
	));
                  
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} 
	else {}

	$json= json_decode($response); 
	$total = $json->total;
	echo "<br>";

	for($x = 0; $x <= 10; $x++){
	
		$result .= "For ";
		$result .= $json->results[$x]->title;
		$result .= ", you can eat here:";
		$result .= "<br>";
		$result .= "<br>";

		$curl2 = curl_init();

		curl_setopt_array($curl2, array(
			CURLOPT_URL => "https://api.yelp.com/v3/businesses/search?term=$term&location=$location&radius=$radius",
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
	
		$response = curl_exec($curl2);
		$err = curl_error($curl2);
	
		curl_close($curl);
	
		if ($err) {
			echo "cURL Error #:" . $err;
		}
		else {}
	  
		$json= json_decode($response); //prints out the array in a neat format
		$total = $json->total;;
	
		$result .= "<br>";
	
		for ($x = 0; $x < $total; $x++) {
			$result .= "<br>";
			$result .= "<br>";
			$result .= "<br>";
			$result .= $json->businesses[$x]->name;
			$result .= "<br>";
			$result .= "Rating: ";
			$result .= $json->businesses[$x]->rating;
			$result .= "<br>";
			$result .= $json->businesses[$x]->location->address1;
			$result .= " ";
			$result .= $json->businesses[$x]->location->city;
			$result .= ", ";
			$result .= $json->businesses[$x]->location->state;
			$result .= " ";
			$result .= $json->businesses[$x]->location->zip_code;
			$result .= "<br>";
			$image = $json->businesses[$x]->image_url;
			$imageData = base64_encode(file_get_contents($image));
			$result .= '<img src="data:image/jpeg;base64,'.$imageData.'" width="128" height="128">';
		} 

	}
	//$all_info = array('data'=>$data);
	echo "\n\n\t***Set Date***\n\n";
	return json_encode($result);
}


//Food Search
function doSearch($username,$search){
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/search?number=100&query=$search",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
    			"X-RapidAPI-Key: e15d210dd7mshd26dc31e4212daep1fb5d2jsnb33fb9faa4f2"
 		),
	));

	echo "<pre>";
	echo curl_exec($curl);
	echo "</pre>";
                  
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
 		echo "cURL Error #:" . $err;
	}
	else {
	}

	$json= json_decode($response); 
	$total = $json->total;
	echo "<br>";

	$result = "";

	for($i=0;$i<10;$i++){
		$result .= "<br>Recipe: ";
		$result .= $json->results[$i]->title;	
		$result .= "<br>Calories: " ;
		$result .= $json->results[$i]->calorie;	
		$result .= "<br>Image: ";
		$result .= $json->results[$i]->image;
		$result .= "<br>";
		$result .= "<br>";
	}

      //$all_info = array('data'=>$data);
      echo "\n\n\t***Search Food***\n\n";
      return json_encode($result);

}


//Food Reccomendation
function doFood($username, $search, $cuisine, $diet, $restrictions, $type, $calories)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?query=$search&cuisine=$cuisine&diet=$diet&excludeIngredients=$restrictions&type=$type&minCalories=0&maxCalories=$calories&limitLicense=false&offset=0&number=100",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			"X-RapidAPI-Key: e15d210dd7mshd26dc31e4212daep1fb5d2jsnb33fb9faa4f2"
		),
	));

	echo "<pre>";
	echo curl_exec($curl);
	echo "</pre>";
                  
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} 
	else {}

	$json= json_decode($response); 
	$total = $json->total;
	echo "<br>";

	$result = "";

	for($i=0;$i<10;$i++){
		$result .= "<br>Recipe: ";
		$result .= $json->results[$i]->title;	
		$result .= "<br>Calories: " ;
		$result .= $json->results[$i]->calorie;	
		$result .= "<br>Image: ";
		$result .= $json->results[$i]->image;
		$result .= "<br>";
		$result .= "<br>";
	}

      //$all_info = array('data'=>$data);
      echo "\n\n\t***Show Profile***\n\n";
      return json_encode($result);
}

?>

