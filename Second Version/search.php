	
<?php

$search = $_GET['search'];

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
} else {
	
}

  
$fp = fopen ( $url , "r" ); 
$contents = "";
while ( $more = fread ( $fp, 1000  ) ) {      $contents .=  $more ;   }
echo $contents ; 


$json= json_decode($contents); 
$total = $json->total;
echo "<br>";

for($i=0;$i<$total;$i++){
echo "<br>Recipe: ";
echo $json->results[$i]->title;	
echo "<br>Calories: " ;
echo $json->results[$i]->calorie;	
echo "<br>Image: ";
echo $json->results[$i]->image;
echo "<br>";
echo "<br>";
}

?>
