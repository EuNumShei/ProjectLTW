<?php
  declare(strict_types = 1);

  class User {
    public ?int $id;
    public string $username;
    public string $email;
    public string $password_hash;
    public int $op;

    public function __construct(?int $id, string $username, string $email, string $password_hash, int $op = 0) {
      $this->id = $id;
      $this->username = $username;
      $this->email = $email;
      $this->password_hash = $password_hash;
      $this->op = $op;
    }

    public function saveInsert($dbh) {
      $sql = "INSERT INTO users (username, email, password_hash, op) VALUES (?, ?, ?, ?)";

      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(1, $this->username);
      $stmt->bindValue(2, $this->email);
      $stmt->bindValue(3, $this->password_hash);
      $stmt->bindValue(4, $this->op);

      try {
        $stmt->execute();
        $this->id = (int)$dbh->lastInsertId();
        header("Location: /pages/login.php");
      } catch (PDOException $e) {
        if($e->getMessage() == 'SQLSTATE[23000]: Integrity constraint violation: 19 UNIQUE constraint failed: users.email'){
          $_SESSION['error'] = 'Email already exists';
        }else{
          die($e->getMessage());
        }
      }

      if($stmt->errorCode() != 0) {
          echo 'SQL error: ' . print_r($stmt->errorInfo(), true);
      }
    }

    function saveUpdate($db, string $changeType) {
      if($changeType == "username") {
          $stmt = $db->prepare('UPDATE users SET username = ? WHERE id = ?');
          $params = array($this->username, $this->id);
      } elseif($changeType == "email") {
          $stmt = $db->prepare('UPDATE users SET email = ? WHERE id = ?');
          $params = array($this->email, $this->id);
      } elseif($changeType == "password") {
          $stmt = $db->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
          $params = array($this->password_hash, $this->id);
      } elseif($changeType == "op") {
          $stmt = $db->prepare('UPDATE users SET op = ? WHERE id = ?');
          $params = array($this->op, $this->id);
      } else {
          return 1;
      }
  
      if($stmt->execute($params)){
          return 0;
      } else {
          return 1;
      }
  }

    static function removeUser(PDO $dbh, int $id) {
      $stmt = $dbh->prepare('DELETE FROM users WHERE id = ?');
      $stmt->execute(array($id));
    }

    static function get_all_users(PDO $db) : array {
      $stmt = $db->prepare('SELECT * FROM users');
      $stmt->execute();
      return $stmt->fetchAll();
    }

    static function getUserByEmail(PDO $db, string $email) : ?User {
      $stmt = $db->prepare('SELECT id, username, email, password_hash, op FROM users WHERE email = ?'); 

      $stmt->execute(array($email));
      $user = $stmt->fetch();
      
      if ($user) {
      return new User(
        $user['id'],
        $user['username'],
        $user['email'],
        $user['password_hash'],
        $user['op']
      );
      } else {
      return null;
      }
    }

    static function getUserById(PDO $db, int $id) : ?User {
      $stmt = $db->prepare('SELECT id, username, email, password_hash, op FROM users WHERE id = ?');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      if ($user) {
      return new User(
        $user['id'],
        $user['username'],
        $user['email'],
        $user['password_hash'],
        $user['op']
      );
      } else {
      return null;
      }
    }

    static function getUsernameById(PDO $dbh, int $id) {
      $stmt = $dbh->prepare('SELECT username FROM users WHERE id = ?');

      $stmt->execute(array($id));
      $result = $stmt->fetch();
      return $result ? $result['username'] : false;
    }

    static function toggleUserOp(PDO $dbh, int $id) {
      $stmt = $dbh->prepare('UPDATE users SET op = (op + 1) % 2 WHERE id = ?');
      $stmt->execute(array($id));
    }

    function username() {
      return $this->username;
    }

    function email() {
      return $this->email;
    }

    function password_hash() {
      return $this->password_hash;
    }

    function op() {
      return $this->op;
    }

  }