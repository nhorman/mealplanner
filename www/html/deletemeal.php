<!DOCTYPE html>
<html>
<body>
<p>DELETING MEALS
<?
	include 'vars.php';
	print_r($_POST);
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$stmt = $connection->query("SELECT * from meals");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$name=$row["name"];
		if(!empty($_POST["{$name}"])) {
			echo "<p> ${name}";
			#$result = $connection->query("UPDATE meals SET famfavorite=true WHERE name='{$name}'");
		}
	}
?>
</body>
</html>
