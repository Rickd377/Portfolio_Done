<?php
session_start();
// is het een post request?
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  // dit mag niet

  // doe een redirect naar de login pagina
  header("Location: ../login.php");
}

require "../model/deal.php";
require "../extra/dbh.php";

$db = new Dbh();
$pdo = $db->Connect();

//check of er al een deal actief die nog niet is afgelopen
$activeDeal = Deal::checkActiveDeal($pdo);	
if($activeDeal == false){
  try {
    // haal de data uit de post
    //$dealId = $_POST['dealId'];
    $productId = $_POST["productId"];
    $dealName = $_POST["dealName"];
    $newPrice = $_POST["newPrice"];
    $dateFrom = $_POST["dateFrom"];
    $dateTo = $_POST["dateTo"];
    $img = $_FILES["fileToUpload"];
    // maak een nieuwe deal aan
    if($img['size'] > 0){
      if(uploadImage()){
          $img = $img['name'];
      }
  } else {
      $img = null;
  }
  
    //haal gevens van product op

    $sql = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $sql->bindParam(":id", $productId);
    $sql->execute();

    //haal prijs van product op

    $product = $sql->fetch();
    $productPrice = $product['price'];

    //bereken korting

    $discountPercentage = round((($productPrice - $newPrice) / $productPrice) * 100);
  
  
    // hier gaan we de data in de database zetten
    $sql = $pdo->prepare("INSERT INTO deal (new_price, discount_percentage, date_from, date_to, image, product_id, deal_name) VALUES (:new_price, :discount_percentage, :date_from, :date_to, :image, :product_id, :deal_name)");
  
    $sql->bindParam(":new_price", $newPrice);
    $sql->bindParam(":discount_percentage", $discountPercentage);
    $sql->bindParam(":date_from", $dateFrom);
    $sql->bindParam(":date_to", $dateTo);
    $sql->bindParam(":image", $img);
    $sql->bindParam(":product_id", $productId);
    $sql->bindParam(":deal_name", $dealName);
  
    $sql->execute();
  
    // dit om te kijken of een rij is toegevoegd
    $rowCount = $sql->rowCount();
  
  
    if ($rowCount > 0) {
      header("Location: ../admin-deal.php?success=Deal added");
      echo "Deal added";
    } else {
      //header("Location: ../admin-productAdd.php?error=AAAAAAAAA went wrong, please try again later");
    }
  } catch (\DealException $e) {
    echo $e->getMessage();
    //header("Location: ../admin-productenAdd.php?error=" . $e->getMessage());
  } catch (PDOException $e) {
    echo $e->getMessage();
    //header("Location: ../admin-productenAdd.php?error=" . $e->getMessage());
  }
}
else{
  header ("Location: ../admin-deal.php?error=Er is al een actieve deal");
}

function uploadImage()
  {
    $target_dir =  '../img/';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      //echo "File is not an image.";
      $uploadOk = 0;
    }
  
    // Check if file already exists
    if (file_exists($target_file)) {
      return true;
    }
  
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
  
    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
  
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        return true;
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    return false;
  }

