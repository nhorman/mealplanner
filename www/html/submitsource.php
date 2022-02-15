<!DOCTYPE html>
<html>
<body>
<?
	include 'vars.php';
	$sourcename=$_POST["name"];
	$returnurl = $_POST["ref"];
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$result = $connection->query("INSERT into sources (name) VALUES ('${sourcename}')");
	if ($result == FALSE) {
		echo "<p> Failed to insert new source: {$result}</p>"; 
	}

	echo "<a href=$returnurl>Back to Where you were</a>";
?>
</body>
</html>
