<!DOCTYPE html>
<html>
<body>
<?
	include 'vars.php';
	$plan=$_POST["plan"];
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
	$plandata = $connection->prepare("SELECT * from plans WHERE name='{$plan}'");
	$plandata->execute([1]);
	$row = $plandata->fetch();
	
	if (!empty($_POST["print_meals"])) {
		$plandata = $connection->prepare("SELECT * from plans WHERE name='{$plan}'");
		$plandata->execute([1]);
		$row = $plandata->fetch();
		echo "<h1><bold>Meal Plan</bold></h1>";
		echo "<table align=center border=1 width=100%>";
		echo "<tr><th>Day</th><th>Meal</th><th>Source</th><th>Location</th></tr>";
		foreach ($days as &$day) {
			$meal = $row["{$day}"];
			$mealdata = $connection->prepare("SELECT * from meals WHERE name='{$meal}'");
			$mealdata->execute([1]);
			$mealdata = $mealdata->fetch();
			$source = $mealdata["source"];
			$location = $mealdata["location"];
			echo "<tr>";
			echo "<td>{$day}</td><td>{$meal}</td><td>{$source}</td><td>{$location}</td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	if (!empty($_POST["print_ingreedients"])) {
		$allings = array();
		foreach ($days as &$day) {
			$meal = $row["{$day}"];
			$stmt = $connection->prepare("SELECT * from ingreedients where meal='{$meal}'");
			$stmt->execute();
			$ings = $stmt->fetchAll();
			foreach ($ings as &$ingreedient) {
				array_push($allings, $ingreedient["name"]);
			}
		}
		$allings = array_unique($allings);
		echo "<h1><bold>Meal Ingreedients</bold></h1>";
		echo "<ul>";
		foreach ($allings as &$ing) {
			echo "<li> $ing </li>";
		}
		echo "</ul>";
		$planenc = rawurlencode($plan);
		echo "<a href=printcsv.php?plan={$planenc}>Print csv</a>";
	}
?>
	<p></p>
	<a href="/index.php">Main Page<a/>
</body>
</html>
