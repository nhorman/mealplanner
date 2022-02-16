<!DOCTYPE html>
<html>
<body>
<?
	include 'vars.php';
	$name=$_POST["name"];
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	$query = "INSERT into plans (name, sunday, monday, tuesday, wednesday, thursday, friday, saturday) VALUES ('{$name}', ";
	foreach ($days as &$day) {
		$daymeal = $_POST["{$day}"];
		$query .="'${daymeal}',";
	}
	$query = rtrim($query, ",");
	$query .= ")";
	$result = $connection->query($query);
	if ($result == FALSE) {
		echo "<p> Unable to save meal plan\n</p>";
	}


	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
	$stmt = $connection->prepare("SELECT * from plans where name='${name}'");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		foreach($days as &$day) {
			print_r($row);
			$meal = $row["{$day}"];
			echo "<p>updating times made for {$day} / {$meal}</p>";
			$connection->query("UPDATE meals SET timesmade=timesmade+1 where name='${meal}'");
		}
	}
	
?>
	<p></p>
	<a href="/index.php">Main Page<a/>
</body>
</html>
