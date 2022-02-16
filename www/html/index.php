<!DOCTYPE html>
<html>
<body>

<h1>Meal Planner</h1>  
      <?  


	function tableExists($pdo, $table) {

		// Try a select statement against the table
		// Run it in try-catch in case PDO is in ERRMODE_EXCEPTION.
		try {
			$result = $pdo->query("SELECT 1 FROM {$table} LIMIT 1");
		} catch (Exception $e) {
			// We got an exception (table not found)
			return FALSE;
		}

		// Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
		return $result !== FALSE;
	}

	function createTables($pdo) {
		$sources_exists = tableExists($pdo, "sources");
		if ($sources_exists == FALSE) {
			echo "<p>Creating sources table\n</p>";
			$result = $pdo->query("CREATE TABLE sources (name VARCHAR(100) NOT NULL, PRIMARY KEY(name))");
			if ($result == FALSE) {
				echo "<p>create table sources failed: {$result} </p>";
				return FALSE;
			}
			$result = $pdo->query("INSERT into sources (name) VALUES ('NOTHING')");
		}
		$meals_exists = tableExists($pdo, "meals");
		if ($meals_exists == FALSE) {
			echo "<p>Creating meals table\n</p>";
			$result = $pdo->query("CREATE TABLE meals (name VARCHAR(100) NOT NULL, source VARCHAR(100) NOT NULL, famfavorite BOOLEAN NOT NULL, timesmade INT NOT NULL, FOREIGN KEY (source) REFERENCES sources(name), location VARCHAR(512), PRIMARY KEY (name))");
			if ($result == FALSE) {
				echo "<p>create table meals failed: {$result} </p>";
				return FALSE;
			}
			$result = $pdo->query("INSERT into meals (name, source, location, famfavorite, timesmade) VALUES ('NOTHING', 'NOTHING', 'NOTHING', false, 0)");
		}
		$ingred_exists = tableExists($pdo, "ingreedients");
		if ($ingred_exists == FALSE) {
			echo "<p>Creating ingreedients table\n</p>";
			$result = $pdo->query("CREATE TABLE ingreedients (id MEDIUMINT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, meal VARCHAR(100) NOT NULL, FOREIGN KEY (meal) REFERENCES meals(name), PRIMARY KEY(id))");
			if ($result == FALSE) {
				echo "<p> create table ingreedients failed: {$result}</p>";
				return FALSE;
			}
		}
		$plan_exists = tableExists($pdo, "plans");
		if ($plan_exists == FALSE) {
			echo "<p>Creating plan table\n</p>";
			$result = $pdo->query("CREATE TABLE plans (name VARCHAR(100) NOT NULL, sunday VARCHAR(100), monday VARCHAR(100), tuesday VARCHAR(100), wednesday VARCHAR(100), thursday VARCHAR(100), friday VARCHAR(100), saturday VARCHAR(100), PRIMARY KEY(name), FOREIGN KEY (sunday) REFERENCES meals(name), FOREIGN KEY (monday) REFERENCES meals(name), FOREIGN KEY (tuesday) REFERENCES meals(name), FOREIGN KEY (wednesday) REFERENCES meals(name), FOREIGN KEY (thursday) REFERENCES meals(name), FOREIGN KEY (friday) REFERENCES meals(name), FOREIGN KEY (saturday) REFERENCES meals(name))");
			if ($result == FALSE) {
				echo "<p> Create table plans failed\n</p>";
				return FALSE;
			}
		}
		return TRUE;
	}

	include 'vars.php';

	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);  
	$result = createTables($connection);
	if ($result == FALSE) {
		return;
	}

	
?>
	<p>Select your option</p>
	<a href="createmeal.php">Create a Meal</a>
	<p></p>
	<a href="planmeals.php">Plan a week of meals</a>
	<p></p>
	<a href="printplan.php">Print your meal plan</a>
	<p></p>
	<a href="mealstats.php">See meal statistics</a>
</body>
</html>
