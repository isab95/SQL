<?php
try {
    $pdo = new pdo('mysql:host=localhost;dbname=weatherapp;charset=utf8','root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM météo');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
    die($msg);
}
?>

        <h1>Weather app</h1>
        <table>
            <thead>
                <tr>
                    <th>City</th>
                    <th>High</th>
                    <th>Low</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach($results as $row):?>
                    <tr>
                        <td><?php echo $row['ville']; ?></td>
                        <td><?php echo $row['haut']; ?></td>
                        <td><?php echo $row['bas']; ?></td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>