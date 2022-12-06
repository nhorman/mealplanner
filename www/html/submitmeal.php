<!DOCTYPE html>
<html>
<body>
<?
	include 'vars.php';
	$sourcename=$_POST["name"];
	$inglist = preg_split("/\r\n|\n|\r/", $_POST["ingreedients"]);
	$name = $_POST["name"];
	$source = $_POST["source"];
	$location = $_POST["location"];
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$result = $connection->query("INSERT into meals (name, source, location, famfavorite, timesmade, hide) VALUES ('{$name}', '{$source}', '{$location}', false, 0, false)");
	if ($result == FALSE) {
		echo "<p>Unable to insert new meal\n</p>";
	} else {
		foreach ($inglist as &$value) {
			$result = $connection->query("INSERT into ingreedients (name, meal) VALUES ('{$value}', '{$name}')");
			if ($result == FALSE) {
				echo "<p>Unable to insert new ingreedient\n</p>";
			}
		}
	}
	$burl = $_SERVER["HTTP_REFERER"];
	echo "<a href=$burl>Go Back to Meal Creation</a>";
?>
</body>
</html>
