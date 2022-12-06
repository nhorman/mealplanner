<!DOCTYPE html>
<html>
<body>
<p>DELETING MEALS
<?
	include 'vars.php';
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$stmt = $connection->query("SELECT * from meals");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$name=$row["name"];
		$undername=str_replace(' ', '_', $row["name"]);
		if(!empty($_POST["{$undername}"])) {
			$result = $connection->query("UPDATE meals SET hide=true WHERE name='{$name}'");
		} else {
			$result = $connection->query("UPDATE meals SET hide=false WHERE name='{$name}'");
		}
	}
	echo "<p> meal hiding updated, go back to <a href=./mealstats.php>Meal Statistics</a>";
?>
</body>
</html>
