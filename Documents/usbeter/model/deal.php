<?php
class DealException extends Exception
{
}
//laat de deal zien op de homepagina
// haal 
class Deal
{

    private $id;
    private $new_price;
    private $discount_percentage;
    private $date_from;
    private $date_to;
    private $img;
    private $product_id;
    private $deal_name;


    public function __construct($id, $new_price, $discount_percentage, $date_from, $date_to, $img, $product_id, $deal_name)
    {
        $this->setId($id);
        $this->setNewPrice($new_price);
        $this->setDiscountPercentage($discount_percentage);
        $this->setDateFrom($date_from);
        $this->setDateTo($date_to);
        $this->setImg($img);
        $this->setProductId($product_id);
        $this->setDealName($deal_name);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNewPrice()
    {
        return $this->new_price / 100;
    }

    public function getDiscountPercentage()
    {
        return $this->discount_percentage;
    }

    public function getDateFrom()
    {
        return $this->date_from;
    }

    public function getDateTo()
    {
        return $this->date_to;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getDealName()
    {
        return $this->deal_name;
    }

    public static function checkActiveDeal($db)
    {
        $sql = $db->prepare("SELECT * FROM deal WHERE date_from <= NOW() AND date_to >= NOW()");
        $sql->execute();
        $result = $sql->fetch();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function setId($id)
    {
        if ($id !== null && !is_numeric($id)) {
            // hey id moet een nummer zijn
            throw new DealException("ID must be a number");
        }
        $this->id = $id;
    }

    public function setNewPrice($new_price)
    {
        if (is_numeric($new_price) && $new_price < 0) {
            // hey prijs mag niet negatief zijn
            throw new DealException("Price can't be negative");
        }
        $this->new_price = $new_price;
    }

    public function setDiscountPercentage($discount_percentage)
    {
        $this->discount_percentage = $discount_percentage;
    }

    public function setDateFrom($date_from)
    {
        $this->date_from = $date_from;
    }

    public function setDateTo($date_to)
    {
        $this->date_to = $date_to;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    public function setDealName($deal_name)
    {
        // throw new DealException("DE DING IS LANG: " . strlen($deal_name));
        // moet een limit aan het aantal karakter en mag niet leeg zijn
        if (strlen($deal_name) > 255) {
            // hey naam is te lang
            throw new DealException("deal_name cannot be longer than 255 characters or empty");
        }
        $this->deal_name = $deal_name;
    }

    public static function getDealInfo($db, $id)
    {
        $sql = $db->prepare("SELECT * FROM deal WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $result = $sql->fetch();

        $deal = new Deal($id, $result["new_price"], $result["discount_percentage"], $result["date_from"], $result["date_to"], $result["img"], $result["product_id"], $result["deal_name"]);
        return $deal;
    }

    public static function getAllDeals($db)
    {
        try {
            $sql = $db->prepare("SELECT * FROM deal WHERE date_from <= NOW() AND date_to >= NOW()");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            $allDeals = [];

            foreach ($result as $deal) {
                $allDeals[] = new Deal(
                    $deal['id'],
                    $deal['new_price'],
                    $deal['discount_percentage'],
                    $deal['date_from'],
                    $deal['date_to'],
                    $deal['image'],
                    $deal['product_id'],
                    $deal['deal_name']
                );
            }
            return $allDeals;
        } catch (PDOException $e) {
            return $e->getMessage();
        } catch (DealException $e) {
            return $e->getMessage();
        }
    }

    public static function getDealById(PDO $db, $dealId)
    {
        try {
            $query = $db->prepare("SELECT * FROM deal WHERE id = " . $dealId . ";");
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            $deal = new Deal(
                $result['id'],
                $result['new_price'],
                $result['discount_percentage'],
                $result['date_from'],
                $result['date_to'],
                $result['img'],
                $result['product_id'],
                $result['deal_name']
            );
            return $deal;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return $ex->getMessage();
        }
    }

//     public static function dealsToAssocArray($deals): array
//     {
//         $result = array();
//         foreach ($deals as $deal) {
//             $result[] = $deal;
//         }
//         return $result;
//     }
}
