<?php
session_start();

// is het een post request?
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // dit mag niet

    // doe een redirect naar de login pagina
    header("Location: ../login.php");
}

require_once "../model/product.php";
require_once "../extra/dbh.php";

$db = new Dbh();
$pdo = $db->Connect();

try {
  $name = htmlspecialchars($_POST["name"]);
  $description = htmlspecialchars($_POST["description"]);
  $price = htmlspecialchars($_POST["price"]);     
  $img = $_FILES["fileToUpload"];
  $category_id = htmlspecialchars($_POST["category_id"]);

  if($img['size'] > 0){
    if(uploadImage()){
      $img = $img['name'];
    }
  } else {
    $img = null;
  }


    $newProduct = new Product($name, $description, $price, $img, $category_id);


    // hier gaan we de data in de database zetten
    $sql = $pdo->prepare("INSERT INTO product (name, description, price, image, category_id) VALUES (:name, :description, :price, :img, :category_id)");

    $sql->bindParam(":name", $name);
    $sql->bindParam(":description", $description);
    $sql->bindParam(":price", $price);
    $sql->bindParam(":img", $img);
    $sql->bindParam(":category_id", $category_id);

    $sql->execute();

    // dit om te kijken of een rij is toegevoegd
    $rowCount = $sql->rowCount();
    //var_dump($rowCount);



    if ($rowCount > 0) {
        header("Location: ../admin-producten.php");
    } else {
        //header("Location: ../admin-productAdd.php?error=AAAAAAAAA went wrong, please try again later");
    }
} catch (\UserException $e) {
    echo $e->getMessage();
    //header("Location: ../admin-productenAdd.php?error=" . $e->getMessage());
} catch (PDOException $e) {
    echo $e->getMessage();
    //header("Location: ../admin-productenAdd.php?error=" . $e->getMessage());
}


function uploadImage(){
    $target_dir =  '../img/';
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
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
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
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