<?php
include "../extra/dbh.php";
include "../model/product.php";
// stel onze link is ...../?userId=1

session_start();
// check of je bent ingelogd als admin
if (!isset($_SESSION['userId']) && $_SESSION['adminstatus'] !== 1) {
    header("Location: login.php");
    exit();
}

// maak database connectie aan
$db = new Dbh();
$pdo = $db->Connect();

// check of het een post request is
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  // dit mag niet
  header("Location: admin-producten.php");
} else {

  // haal huidige product op.
  $productId = htmlspecialchars($_POST["productId"]); 
  // haal de data uit de post
  $name = htmlspecialchars($_POST["name"]);
  $description = htmlspecialchars($_POST["description"]);

  // bestaat er al een huidig plaatje?
  if(isset($_POST["currentImage"])){
    $image = htmlspecialchars($_POST["currentImage"]);
  } else {
    $image = null;
  }
  // $images = $_POST['image'];
  $price = htmlspecialchars($_POST["price"]);
  $category_id = htmlspecialchars($_POST["category_id"]);
  $newImage = $_FILES['fileToUpload'];

  // check of er een nieuwe image is geupload
    if ($newImage['size'] > 0) {
        // er is een nieuwe image geupload
        // checken of de image naam hetzelfde is.
        if ($newImage['name'] !== $image) {
            // upload een nieuwe image.
            if (uploadImage()) {
                $image = $newImage['name'];
            }

        }
    }

    try {
    // haal de data uit de database
    $sql = $pdo->prepare("UPDATE product SET name = :name, description = :description, price = :price, image = :image, category_id = :category_id WHERE id = :id");      
    
    $sql->bindParam(":name", $name);
    $sql->bindParam(":description", $description);
    $sql->bindParam(":price", $price);
    $sql->bindParam(":image", $image);
    $sql->bindParam(":category_id", $category_id);
    $sql->bindParam(":id", $productId);

    $sql->execute();

    $rowCount = $sql->rowCount();
    

    // if ($rowCount > 0) {
    //     echo 'gelukt';
    // } else {
    //     echo 'niet gelukt';
    // } 
}catch (PDOException $e) {
        echo $e->getMessage();
    }
}
     header("Location: ../admin-producten.php");

if (isset($_POST['delete'])) {
  // product deleten
  $productId = $_POST['productId'];
  $productInfo = Product::GetProductInfo($pdo, $productId);
  $temp = $productInfo->ProductToAssocArray();
  $sql = $pdo->prepare("DELETE FROM product WHERE id = :id");
  $sql->bindParam(":id", $productId);
  $sql->execute();
  $rowCount = $sql->rowCount();
  if ($rowCount > 0) {
      header("Location: ../admin-producten.php");
  } else {
      //header("Location: ../admin-productAdd.php?error=AAAAAAAAA went wrong, please try again later");
  }
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