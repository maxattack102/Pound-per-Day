	
<?php

$search = $_GET['search'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?query=chicken&cuisine=american&excludeIngredients=milk&type=lunch&minCalories=0&maxCalories=1500&limitLicense=false&offset=0&number=100",
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


$json= json_decode($response); 
$total = $json->total;
echo "<br>";

for($x = 0; $x <= $total; $x++){
echo "<br>";
echo "<br>";
echo $json->results[$x]->title;	
echo "<br>";
echo "<br>";
echo $json->results[$x]->calories;	
echo "<br>";
echo "<br>";
echo $json->results[$x]->image;
echo "<br>";
echo "<br>";
}

?>