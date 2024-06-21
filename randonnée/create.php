<?php
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', ''); // Instancie la connexion
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$stmt = $pdo->prepare('INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (:name, :difficulty, :distance, :duration, :height_difference)');
		if ($_SERVER['REQUEST_METHOD'] === "POST") {
			if (isset($_POST["name"]) && isset($_POST["duration"]) && isset($_POST["distance"]) && isset($_POST["height_difference"])) {
				$stmt->bindValue(":name", $_POST["name"], PDO::PARAM_STR);
				$stmt->bindValue(":difficulty", $_POST["difficulty"], PDO::PARAM_STR);
				$stmt->bindValue(":distance", $_POST["distance"], PDO::PARAM_STR);
				$stmt->bindValue(":duration", $_POST["duration"], PDO::PARAM_STR);
				$stmt->bindValue(":height_difference", $_POST["height_difference"], PDO::PARAM_STR);
			}
			$stmt->execute();
			$message = "Data successfully added!";
		}
	}
	catch(PDOException $e) {
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="/php-pdo/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
