<?php

class ProductException extends Exception
{
}

class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $img;
    private $category;

    public function __construct($name, $description, $price, $img, $category = null, $id = null)
    {
        $this->setProductName($name);
        $this->setDescription($description);
        $this->setPrice($price);
        $this->setImg($img);
        $this->setCategory($category);
        $this->setId($id);
    }

    public function getProductName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function getImg()
    {
        return $this->img;
    }

    public function getPrice()
    {
        return $this->price / 100;
    }

    public function getCategory()
    {
        return $this->category;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setProductName($name)
    {
        if (strlen($name) > 255 || strlen($name) < 1) {
            throw new ProductException("Name cannot be longer than 255 characters or empty");
        }
        $this->name = $name;
    }

    public function setDescription($description)
    {
        if (strlen($description) > 255 || strlen($description) < 1) {
            throw new ProductException("Description cannot be longer than 255 characters or empty");
        }
        $this->description = $description;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function setPrice($price)
    {
        if (is_numeric($price) && $price < 0) {
            throw new ProductException("Price can't be negative");

        }
        $this->price = $price;
    }

    public function setCategory($category)
    {
        if ($category !== null && !is_numeric($category)) {
            throw new ProductException("Category must be a number");
        }
        $this->category = $category;
    }

    public function setId($id)
    {
        if ($id !== null && !is_numeric($id)) {
            throw new ProductException("Id must be a number");
        }
        $this->id = $id;
    }

    public static function getAllProducts($db)
    {
        try {
            $query = $db->prepare("
        SELECT
            id,
            name,
            description,
            image,
            price,
            category_id
        FROM
            product
        ORDER BY
            category_id;");

            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($results as $product) {
                $products[] = new Product(
                    $product['name'],
                    $product['description'],
                    $product['price'],
                    $product['image'],
                    $product['category_id'],
                    $product['id'],
                );
            }

            $query = $db->prepare("
            SELECT id, name
            FROM category;");
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $filterItems = [];
            foreach ($results as $filterItem) {
                $filterItems[] = new Filter(
                    $filterItem['id'],
                    $filterItem['name']
                );
            }

            $returnData = [];
            $returnData['products'] = $products;
            $returnData['categories'] = $filterItems;

            return $returnData;
        } catch (PDOException $error) {
            echo "Error :" . $error->getMessage();
        }

    }
    public static function getSpecificCategory($db, $categoryName)
    {
        try {
            $query = $db->prepare("
        SELECT
            product.id,
            product.name,
            description,
            image,
            price,
            category.id AS category
        FROM
            `product`
        LEFT JOIN `category` ON product.category_id = category.id
        WHERE category.id = " . $categoryName . ";");

            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($results as $product) {
                $products[] = new Product(
                    $product['name'],
                    $product['description'],
                    $product['price'],
                    $product['image'],
                    $product['category'],
                    $product['id'],
                );
            }

            $query = $db->prepare("
            SELECT id, name
            FROM category WHERE id = :categoryId");
            $query->bindParam(':categoryId', $categoryName);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $filterItems = [];
            foreach ($results as $filterItem) {
                $filterItems[] = new Filter(
                    $filterItem['id'],
                    $filterItem['name']
                );
            }

            $returnData = [];
            $returnData['products'] = $products;
            $returnData['categories'] = $filterItems;

            return $returnData;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public static function getSpecificCategories($db, $categoryNames)
    {

        $categories = explode(',', $categoryNames);
        $categoryString = "";

        for ($x = 0; $x < count($categories); $x++) {
            $categoryString .= $categories[$x];
            if ($x < count($categories) - 1) {
                $categoryString .= " OR category_id = ";
            }
        }

        try {
            $query = $db->prepare("
        SELECT
            product.id,
            product.name,
            description,
            image,
            price,
            category_id
        FROM
            `product`
        WHERE
            category_id = " . $categoryString . ";");

            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($results as $product) {
                $products[] = new Product(
                    $product['name'],
                    $product['description'],
                    $product['price'],
                    $product['image'],
                    $product['category_id'],
                    $product['id'],
                );
            }

            $categoryString = "";
            for ($x = 0; $x < count($categories); $x++) {
                $categoryString .= $categories[$x];
                if ($x < count($categories) - 1) {
                    $categoryString .= " OR id = ";
                }
            }

            $query = $db->prepare("
            SELECT id, name
            FROM category
            WHERE id = $categoryString;");

            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            $filterItems = [];
            foreach ($results as $filterItem) {
                $filterItems[] = new Filter(
                    $filterItem['id'],
                    $filterItem['name']
                );
            }

            $returnData = [];
            $returnData['products'] = $products;
            $returnData['categories'] = $filterItems;

            return $returnData;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public static function getProductById(PDO $db, $productId)
    {
        try {
            $query = $db->prepare("SELECT * FROM product WHERE id = " . $productId . ";");
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            $product = new Product(
                $result['name'],
                $result['description'],
                $result['price'],
                $result['image'],
                $result['category_id']
            );
            return $product;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }

    public function ProductToAssocArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->img,
            'category_id' => $this->category
        ];
    }

    public static function GetProductInfo($db, $id)
    {
        $sql = $db->prepare("SELECT name, description, price, image, category_id FROM product WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $result = $sql->fetch();

        $product = new Product($result["name"], $result["description"], $result["price"], $result["image"], $result["category_id"], $id);
        return $product;
    }
}