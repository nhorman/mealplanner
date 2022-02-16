<!DOCTYPE html>
<html>
<body>

<h1>Print a Meal Plan</h1>  
	<form action="submitmealprint.php" id="mealform" method="post" >
		<div>
			<label for="name">Plan Name:</label>
			<p></p>
			<select id="plan" name="plan">
		<?
			include 'vars.php';
			$connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
			$stmt = $connection->prepare("SELECT name from plans");
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo "<option value=\"{$row["name"]}\"> {$row["name"]} </option>";
			}
		?>
		</select>
		<p></p>
		<input type="checkbox" id="print_meals" name="print_meals" value="yes">
		<label for="print_meals" checked>Print Meal List</label>
		<p></p>
		<input type="checkbox" id="print_ingreedients" name="print_ingreedients" value="yes">
		<label for="print_ingreedients">Print Shopping List</label>
		</div>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
