<!DOCTYPE html>
<html>
<body>

<h1>Meal Statistics</h1>  
		<h1><bold> TOP 10 MEALS </bold></h1>
		<?
			include 'vars.php';
			$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
			$stmt = $connection->prepare("SELECT * from meals ORDER BY timesmade DESC LIMIT 10");
			$stmt->execute();
			echo "<ol>";
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<li>{$row["name"]} (made {$row["timesmade"]} times)</li>";
                        }
			echo "</ol>";
		?>

		<h1><bold> Family Favorites </bold></h1>
		<form action="updatefavs.php" id="mealform" method="post" >
                <div>
                <?
			$stmt = $connection->prepare("SELECT * from meals ORDER by famfavorite=true");
			$stmt->execute();
			echo "<ul>";
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo "<li>";
				if ($row["famfavorite"] == TRUE)
				{
					echo "<input type=checkbox name={$row["name"]} value=yes checked>";
				} else {
					echo "<input type=checkbox name={$row["name"]} value=yes>";
				}
				echo "<label for={$row["name"]}>{$row["name"]}</label>";
				echo "</li>";
			}
			echo "</ul>";
                ?>
                </div>
                <button type="submit">Submit</button>
		</form>

		
</body>
</html>
