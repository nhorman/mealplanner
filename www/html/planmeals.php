<!DOCTYPE html>
<html>
<body>

<h1>Create a Meal Plan</h1>  
	<form action="submitmealplan.php" id="mealform" method="post" >
		<div>
			<label for="name">Meal Name:</label>
			<input type="text" id="name" name="name" />
			<p></p>
		<?
			include 'vars.php';
			$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
			$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			foreach ($days as &$day) {
				echo "<label for={$day}>{$day}</label>";
				echo "<select id={$day} name={$day}>";
				$stmt = $connection->prepare("SELECT name from meals");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option value=\"{$row["name"]}\"> {$row["name"]} </option>";
				}
				echo "</select><p></p>";
			}
		?>
		</div>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
