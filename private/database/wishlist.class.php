<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../../private/database/phone.class.php');

  class Wishlist {
    public int $id;

    public function __construct(int $id){
      $this->id = $id;
    }

    static function getWishlistByUserId($dbh, int $userId): array {
        $stmt = $dbh->prepare('SELECT * FROM wishlist WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    static function getWishlistPhones(PDO $dbh, int $userId): array {
        $stmt = $dbh->prepare('SELECT phone_id FROM wishlist WHERE user_id = ?');
        $stmt->execute([$userId]);
        $phoneIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $phones = [];
        foreach ($phoneIds as $phoneId) {
            $phones[] = Phone::get_phone_by_id($dbh, $phoneId);
        }
        
        return $phones;
    }

    static function addCartPhones(PDO $dbh, array $ids) : array {
        $phones = [];
        foreach($ids as $id){
          $phones[] = Phone::get_phone_by_id($dbh, $id);
        }
        return $phones;
    }

    static function addPhoneWishlist(PDO $dbh, int $user_id, int $phone_id) {
      $stmt = $dbh->prepare('INSERT INTO wishlist (user_id, phone_id) VALUES (?, ?)');
      $stmt->execute([$user_id, $phone_id]);

      $id = $dbh->lastInsertId();
      return $id;
    }

    static function deletePhoneWishlist(PDO $dbh, int $user_id, int $phone_id) {
      $stmt = $dbh->prepare('DELETE FROM wishlist WHERE user_id = ? AND phone_id = ?');
      $stmt->execute([$user_id, $phone_id]);
    }

  }   