<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fonction d'agrégation</title>
</head>
<body>
    <?php
    require 'Connect.php';
    require 'Config.php';

    $myConnexion = Connect::dbConnect();

    try {
        $stmt = $myConnexion->prepare("SELECT MIN(age) as minimum FROM user");
        $state = $stmt->execute();

        if ($state) {
            $min = $stmt->fetch();
            echo "Le plus petit âge trouvé est: " . $min['minimum']. "ans" . "<br>";
        }

        $stmt = $myConnexion->prepare("SELECT MAX(age) as maximum FROM user");
        $state = $stmt->execute();

        if ($state) {
            $max = $stmt->fetch();
            echo "Le plus grand âge trouvé est: " . $max['maximum']. "ans". "<br>";
        }

        $stmt = $myConnexion->prepare("SELECT count(*) as number FROM user");
        $state = $stmt->execute();

        if ($state) {
            $count = $stmt->fetch();
            echo "Il y a : " . $count['number']. "utilisateurs". "<br>";
        }

        $stmt = $myConnexion->prepare("SELECT count(*) as number FROM user WHERE numero >= 5");
        $state = $stmt->execute();

        if ($state) {
            $count = $stmt->fetch();
            echo "Il y a : " . $count['number']. "utilisateurs ayant un numéro de rue plus grand ou égal à 5" . "<br>";
        }

        $stmt = $myConnexion->prepare("SELECT AVG(age) as moyenne_age FROM user");
        $state = $stmt->execute();

        if ($state) {
            $average = $stmt->fetch();
            echo "L'âge moyen est  " . $average['moyenne_age']. "ans". "<br>";
        }

        $stmt = $myConnexion->prepare("SELECT SUM(numero) as somme_numero FROM user");
        $state = $stmt->execute();

        if ($state) {
            $sum = $stmt->fetch();
            echo "La somme des numéros de maison est : " . $sum['somme_numero']. "<br>";
        }
    }
    catch (PDOException $exception) {
        echo $exception->getMessage();
    }



    ?>
</body>
</html>

