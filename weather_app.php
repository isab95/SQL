<?php
try {
    $pdo = new pdo('mysql:host=localhost;dbname=weatherapp;charset=utf8','root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM météo');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Add data in database
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['city']) && isset($_POST['high']) && isset($_POST['low'])) {
            $querry = $pdo->prepare("INSERT INTO météo (ville, haut, bas) VALUES (:city, :high, :low)");
            $querry->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
            $querry->bindParam(':high', $_POST['high'], PDO::PARAM_INT);
            $querry->bindParam(':low', $_POST['low'], PDO::PARAM_INT);
            if(!$querry->execute()){
                echo "something don't work";
            }
            else{
                header('Location: ' . $_SERVER['PHP_SELF']);
            }
        }

        //DELETE data(row) from database
        foreach($results as $row) {
            $city=$row['ville'];
            if (isset(_POST[$city]) && _POST[$city] == "on"){
                echo "hey i'm trying to delete this $city city";
                $query2 = $pdo->prepare("DELETE FROM weather WHERE ville=:city_delete");
                $query2->bindParam(":city_delete", $city, PDO::PARAM_STR);
                if (!$query2->execute()) {
                    echo "Could not delete city";
                } else {
                    header('Location: ' . $_SERVER['PHP_SELF']);
                }
            }
        }
    }

}
catch(PDOException $e) {
    $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
    die($msg);
}
?>

    <h1>Weather app</h1>
    <form action="" method="POST">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>City</th>
                    <th>High</th>
                    <th>Low</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach($results as $row):?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $row['ville']; ?>"></td>
                        <td><?php echo $row['ville']; ?></td>
                        <td><?php echo $row['haut']; ?></td>
                        <td><?php echo $row['bas']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <tr>
                    <td><button type='submit'>Add</button></td>
                    <td><input type="text" name="city" required></td>
                    <td><input type="number" name="high" required></td>
                    <td><input type="number" name="low" required></td>
                </tr>
                    
            </tbody>
        </table>
    </form>