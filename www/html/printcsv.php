<?
	header('Content-Description: File Transfer');
        header('Content-Type: application/text');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="shoppinglist.csv"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');
	include 'vars.php';
	$plan=$_GET["plan"];
	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
	$plandata = $connection->prepare("SELECT * from plans WHERE name='{$plan}'");
        $plandata->execute([1]);
        $row = $plandata->fetch();
	$days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
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
	echo "item\n";
	foreach ($allings as &$ing) {
		echo "{$ing}\n";
	}
?>
