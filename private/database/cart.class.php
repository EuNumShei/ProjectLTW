<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../../private/database/user.class.php');

  class Cart {
    public int $id;
    public int $buyer;
    public int $seller;
    public string $products;
    public string $prices;

    public function __construct(int $id, int $buyer, int $seller, string $products, string $prices){
        $this->id = $id;
        $this->buyer = $buyer;
        $this->seller = $seller;
        $this->products = $products;
        $this->prices = $prices;
    }

    static function get_all_carts(PDO $dbh) : array {
        $stmt = $dbh->prepare('SELECT * FROM cart');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static function getCartByBuyer($dbh, int $userId): array {
        $stmt = $dbh->prepare('SELECT * FROM cart WHERE buyer = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    static function getCartBySeller(PDO $dbh, int $seller) {
        $stmt = $dbh->prepare('SELECT * FROM cart WHERE seller = ?');
        $stmt->execute([$seller]);
        $cart = $stmt->fetchAll();
        return $cart;
    }

    static function getCartSellers(PDO $dbh, int $id) : array{
        $stmt = $dbh->prepare('SELECT seller FROM cart WHERE id = ?');
        $stmt->execute([$id]);
        $ids = $stmt->fetchAll();
        foreach($ids as $key => $value){
            $ids[$key] = User::getUserById($dbh, $value['seller'])->username;
        }
        return $ids;
    }

    static function getCartPhones(PDO $dbh, int $id): array {
        $stmt = $dbh->prepare('SELECT products FROM cart WHERE id = ?');
        $stmt->execute([$id]);
        $phoneNames = $stmt->fetch(PDO::FETCH_ASSOC)['products'];
        $phoneNames = explode(",", $phoneNames);
        
        return $phoneNames;
    }

    static function getCartPrices(PDO $dbh, int $id): array {
        $stmt = $dbh->prepare('SELECT prices FROM cart WHERE id = ?');
        $stmt->execute([$id]);
        $phonePrices = $stmt->fetch(PDO::FETCH_ASSOC)['prices'];
        $phonePrices= explode(",", $phonePrices);
        
        return $phonePrices;
    }

    static function getCartTimestamp(PDO $dbh, int $id): string {
      $stmt = $dbh->prepare('SELECT purchase_time FROM cart WHERE id = ?');
      $stmt->execute([$id]);
      $purchase_time = $stmt->fetch(PDO::FETCH_ASSOC)['purchase_time'];
      
      return $purchase_time;
  }

    static function addPurchaseCart(PDO $dbh, int $user_id, int $seller, string $products, string $prices) {
      $stmt = $dbh->prepare('INSERT INTO cart (buyer, seller, products, prices) VALUES (?, ?, ?, ?)');
      $stmt->execute([$user_id, $seller, $products, $prices]);

      $id = $dbh->lastInsertId();
      return $id;
    }
  }