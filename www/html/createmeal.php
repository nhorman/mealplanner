<!DOCTYPE html>
<html>
<body>

<h1>Create a Meal</h1>  
	<form action="submitmeal.php" method="post" >
		<div>
			<label for="name">Meal Name:</label>
			<input type="text" id="name" name="name" />
			<p></p>
			<label type="text">Source:</label>
			<select>
		<?
			include 'vars.php';
			$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
			$stmt = $connection->prepare("SELECT name from sources");
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo "<option> {$row["name"]} </option>";
			}
		?>
		</select>
		<a href="createsource.php">Create a New Source</a>
		<p></p>
		<label for="location">Location:</label>
		<input type="text" id="location" name="location"/>
		<p></p>
		<label for="ingreedients">Ingreedients:</label>
		<textarea id="ingreedients" name"ingreedients" rows="20" cols="50"></textarea>
		</div>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
