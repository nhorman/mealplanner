<!DOCTYPE html>
<html>
<body>

<h1>Hello World!</h1>  
      <p><?php echo 'We are running PHP, version: ' . phpversion(); ?></p>  
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
			$result = $pdo->query("CREATE TABLE sources (name VARCHAR(100) NOT NULL, PRIMARY KEY(name))");
			if ($result == FALSE) {
				echo "<p>create table sources failed: {$result} </p>";
				return FALSE;
			}
		}
		$meals_exists = tableExists($pdo, "meals");
		if ($meals_exists == FALSE) {
			$result = $pdo->query("CREATE TABLE meals (name VARCHAR(100) NOT NULL, source VARCHAR(100) NOT NULL, FOREIGN KEY (source) REFERENCES sources(name), location VARCHAR(512), PRIMARY KEY (name))");
			if ($result == FALSE) {
				echo "<p>create table meals failed: {$result} </p>";
				return FALSE;
			}
		}
		$ingred_exists = tableExists($pdo, "ingreedients");
		if ($ingred_exists == FALSE) {
			$result = $pdo->query("CREATE TABLE ingreedients (id MEDIUMINT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, meal VARCHAR(100) NOT NULL, FOREIGN KEY (meal) REFERENCES meals(name), PRIMARY KEY(id))");
			if ($result == FALSE) {
				echo "<p> create table ingreedients failed: {$result}</p>";
				return FALSE;
			}
		}
		return TRUE;
	}

	$database ="mpdb";  
	$user = "root";  
	$password = "secret";  
	$host = "mysql";  

	$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);  
	$query = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_TYPE='BASE TABLE'");  
	$result = createTables($connection);
	if ($result == FALSE) {
		return;
	}

       $tables = $query->fetchAll(PDO::FETCH_COLUMN);  

        if (empty($tables)) {
          echo "<p>There are no tables in database \"{$database}\".</p>";
        } else {
          echo "<p>Database \"{$database}\" has the following tables:</p>";
          echo "<ul>";
            foreach ($tables as $table) {
              echo "<li>{$table}</li>";
            }
          echo "</ul>";
        }
?>
</body>
</html>
