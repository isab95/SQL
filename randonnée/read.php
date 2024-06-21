<?php
  //connecting to db and fetch data
  $pdo = new pdo('mysql:host=localhost;dbname=becode;charset=utf8','root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $pdo->prepare('SELECT * FROM hiking');
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
      <!-- Afficher la liste des randonnées -->
      <thead>
        <tr>
          <th>Name</th>
          <th>Difficulty</th>
          <th>Distance</th>
          <th>Duration</th>
          <th>Height difference</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($results as $row):?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['difficulty']; ?></td>
            <td><?php echo $row['distance']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td><?php echo $row['height_difference']; ?></td>
          </tr>
        <?php endforeach; ?>
    </table>
  </body>
</html>
