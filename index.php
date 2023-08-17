<?php 
	$urlContents = file_get_contents("https://www.fruityvice.com/api/fruit/all");
	$fruitArray = json_decode($urlContents, true);
	$error = "";

	if ($fruitArray == null) {

		$error = "No fruit available";
	}

	$fruitInfo ="";

	if (array_key_exists('fruit_name', $_GET)) {
		$fruitName = $_GET['fruit_name'];
		$urlSingleFruit = file_get_contents("https://www.fruityvice.com/api/fruit/" . $fruitName);
		$fruitInfo = json_decode($urlSingleFruit, true);
	}

 ?>

<!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Fruit Vice Api</title>
 </head>
 <body>
 	<h2>Select a Fruit</h2>
 	<form method="get">
 		<select name="fruit_name">
 			<?php 
	 			if($error ==""){
	 				for ($i=0 ; $i < count($fruitArray); $i++ ) {
	 				echo '<option value ="' .
	 					$fruitArray[$i]['name'] . '">' .
	 					$fruitArray[$i]['name'] .
	 					'</option>';
	 				}
	 				}else{
	 					echo '<span>Woops, No Content. Error is ' . $error . '</span>';
	 				}
	 		 ?>
 			
 		</select>
 		<input type="submit" value=" Get Fruit Info">
 	</form>
 	<?php 
 		if ($fruitInfo != "") {
 			$spaces = "&nbsp;&nbsp;&nbsp;";
 			echo "<h3> Fruit information for " . $fruitInfo['name'] . "</h3>";
 			echo "Genus:" . $fruitInfo['genus'] . "</br>";
 			echo "Family: " . $fruitInfo['family'] . "<br>";
 			echo "Order :" . $fruitInfo['order'] . "<br>";

 			echo "<strong> Nurients:</strong><br>";
 			echo $spaces . "Carbs: " . $fruitInfo['nutritions']['carbohydrates'] . "<br>";
 			echo $spaces . "Proteins: " . $fruitInfo['nutritions']['protein'] . "<br>";
 			echo $spaces . "Fat: " . $fruitInfo['nutritions']['fat'] . "<br>";
 			echo $spaces . "Calories: " . $fruitInfo['nutritions']['calories'] . "<br>";
 			
 		}

 	 ?>
 	
 </body>
 </html>

