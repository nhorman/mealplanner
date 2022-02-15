<!DOCTYPE html>
<html>
<body>
<?
	include 'vars.php';
	$name=$_POST["name"];
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	$query = "INSERT into plans (name, sunday, monday, tuesday, wednesday, thursday, friday, saturday) VALUES ({$name}, ";
	foreach ($days as &$day) {
		$daymeal = $_POST["{$day}"];
		$query .="'${daymeal}',";
	}
	$query = rtrim($query, ",");
	$query .= ")";
	print_r($query);
	$result = $connection->query($query);
	if ($result == FALSE) {
		echo "<p> Unable to save meal plan\n</p>";
	}
?>
</body>
</html>
