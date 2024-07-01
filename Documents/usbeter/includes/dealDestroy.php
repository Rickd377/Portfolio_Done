<?php

// haal deal weg uit datavase


require '../extra/dbh.php';

$db = new Dbh();
$pdo = $db->Connect();

try {
    // haal de data uit de post
    $dealId = $_GET['id'];

    // hier gaan we de data in de database zetten
    $sql = $pdo->prepare("DELETE FROM deal WHERE id = :id");

    $sql->bindParam(":id", $dealId);

    $sql->execute();

    // dit om te kijken of een rij is toegevoegd
    $rowCount = $sql->rowCount();
    header("Location: ../admin-deal.php");
} catch (\DealException $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}
