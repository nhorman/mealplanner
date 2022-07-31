<!DOCTYPE html>
<html>
<body>
<?
	include 'vars.php';
	$sourcename=$_POST["name"];
	$inglist = preg_split("/\r\n|\n|\r/", $_POST["ingreedients"]);
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$meallist = array();
	$totalcount = 0;
	foreach ($inglist as &$value) {
		$totalcount = $totalcount+1;
		$stmt = $connection->query("SELECT * from ingreedients where name='{$value}'");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$name=$row["meal"];
			if (array_key_exists($name, $meallist)) {
				$meallist[$name] = $meallist[$name] + 1;
			} else {
				$meallist[$name] = 1;
			}
		}
	}
	asort($meallist, SORT_NUMERIC);

	echo "<h1><b>Meals that match your available ingredients</b></h1>";
	echo "<ul>";
	foreach ($meallist as $key => $value) {
		echo "<li>";
		echo "{$key} ({$value}/{$totalcount} ingreedients)";
		echo "</li>";
	}
	echo "</ul>";
?>
</body>
</html>
