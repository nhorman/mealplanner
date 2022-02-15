<!DOCTYPE html>
<html>
<body>

<h1>Create a Source</h1>  
	<form action="submitsource.php" method="post">
		<div>
	 		<label for="name">Source Name:</label>
	 		<input type="text" id="name" name="name" />
			<?
			$referrer = $_SERVER["HTTP_REFERER"];
			$text = "<input type=\"hidden\" id=\"ref\" value={$referrer}/>";
	 		echo $text;
			?>
	 		<button type="submit">Submit</button>
	 	</div>
	 </form>
</body>
</html>
