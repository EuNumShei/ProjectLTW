<?php
  declare(strict_types = 1);

  class Phone {
    public int $id;
    public string $category;
    public string $color;
    public float $price;
    public int $storage;
    public string $condition;
    public int $years_used;
    public int $seller;
    public string $image;
    public string $brand;
    public string $model;
    public int $camera;
    public string $cpu;
    public string $size;
    public int $memory;
    public int $battery;
    public string $description;

    public function __construct(int $id, string $category, string $color, float $price, int $storage, string $condition, int $years_used, int $seller, string $image, string $brand, string $model, int $camera, string $cpu, string $size, int $memory, int $battery, string $description)
    {
      $this->id = $id;
      $this->category = $category;
      $this->color = $color;
      $this->price = $price;
      $this->storage = $storage;
      $this->condition = $condition;
      $this->years_used = $years_used;
      $this->seller = $seller;
      $this->image = $image;
      $this->brand = $brand;
      $this->model = $model;
      $this->camera = $camera;
      $this->cpu = $cpu;
      $this->size = $size;
      $this->memory = $memory;
      $this->battery = $battery;
      $this->description = $description;
    }

    static function get_all_phones(PDO $dbh) : array {
      $stmt = $dbh->prepare('SELECT * FROM phones');
      $stmt->execute();
    
      return $stmt->fetchAll();  
    }

    static function get_phone_by_id(PDO $dbh, int $id) : Phone {
      $stmt = $dbh->prepare('SELECT id, category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description FROM phones WHERE id = ?');
      $stmt->execute([$id]);
    
      $phone = $stmt->fetch();  

      return new Phone(
        $phone['id'],
        $phone['category'],
        $phone['color'],
        $phone['price'],
        $phone['storage'],
        $phone['condition'],
        $phone['years_used'],
        $phone['seller'],
        $phone['image'],
        $phone['brand'],
        $phone['model'],
        $phone['camera'],
        $phone['cpu'],
        $phone['size'],
        $phone['memory'],
        $phone['battery'],
        $phone['description']
      );     
    }
  
    static function getColorsPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT color FROM phones ORDER BY color ASC");
      $stmt->execute();
  
      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);
  
      return $unique_values;
    }

    static function getStoragesPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT storage FROM phones ORDER BY storage ASC");
      $stmt->execute();
  
      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);
  
      return $unique_values;
    }

    static function getConditionsPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT condition FROM phones ORDER BY condition ASC");
      $stmt->execute();
  
      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);
  
      return $unique_values;
    }

    static function getYearsUsedPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT years_used FROM phones");
      $stmt->execute();
  
      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);
  
      return $unique_values;
    }

    static function getCategoriesPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT category FROM phones");
      $stmt->execute();
      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }

    static function getModelByBrand(PDO $dbh, string $brand) : array {
      $stmt = $dbh->prepare('SELECT * FROM phones WHERE brand = ?');
      $stmt->execute([$brand]);
    
      return $stmt->fetchAll();  
    }

    static function getBrandsPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT brand FROM phones ORDER BY brand ASC");
      $stmt->execute();

      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }

    static function getCameraPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT camera FROM phones ORDER BY camera ASC");
      $stmt->execute();

      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }

    static function getModelsPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT model FROM phones ORDER BY model ASC");
      $stmt->execute();

      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }

    static function getCPUPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT cpu FROM phones ORDER BY cpu ASC");
      $stmt->execute();

      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }

    static function getSizePhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT size FROM phones ORDER BY size ASC");
      $stmt->execute();

      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }

    static function getMemoryPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT memory FROM phones ORDER BY memory ASC");
      $stmt->execute();

      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }
    
    static function getBatteryPhone(PDO $dbh){
      $stmt = $dbh->prepare("SELECT DISTINCT battery FROM phones");
      $stmt->execute();

      $unique_values = $stmt->fetchAll(PDO::FETCH_COLUMN);

      return $unique_values;
    }

    static function addPhoneDatabase(PDO $dbh, Phone $phone){
      $sql = "INSERT INTO phones (category, color, price, storage, condition, years_used, seller, image, brand, model, camera, cpu, size, memory, battery, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  
      $stmt = $dbh->prepare($sql);
  
      $stmt->execute([
          $phone->category,
          $phone->color,
          $phone->price,
          $phone->storage,
          $phone->condition,
          $phone->years_used,
          $phone->seller,
          $phone->image,
          $phone->brand,
          $phone->model,
          $phone->camera,
          $phone->cpu,
          $phone->size,
          $phone->memory,
          $phone->battery,
          $phone->description
      ]);

      $id = $dbh->lastInsertId();
      return $id;
    }

    static function updatePhoneDatabase(PDO $dbh, Phone $phone){
      $sql = "UPDATE phones SET category = ?, color = ?, price = ?, storage = ?, condition = ?, years_used = ?, seller = ?, image = ?, brand = ?, model = ?, camera = ?, cpu = ?, size = ?, memory = ?, battery = ?, description = ? WHERE id = ?";
  
      $stmt = $dbh->prepare($sql);
  
      $stmt->execute([
          $phone->category,
          $phone->color,
          $phone->price,
          $phone->storage,
          $phone->condition,
          $phone->years_used,
          $phone->seller,
          $phone->image,
          $phone->brand,
          $phone->model,
          $phone->camera,
          $phone->cpu,
          $phone->size,
          $phone->memory,
          $phone->battery,
          $phone->description,
          $phone->id
      ]);
    }

    function updatePhoneValue(PDO $dbh, Phone $phone, string $field, string $value){
      $stmt = $dbh->prepare("UPDATE phones SET $field = ? WHERE id = ?");
      $stmt->execute([$value, $phone->id]);
    }

    static function getPhonesBySeller(PDO $dbh, int $seller) : array {
      $stmt = $dbh->prepare('SELECT * FROM phones WHERE seller = ?');
      $stmt->execute([$seller]);
    
      return $stmt->fetchAll();  
    }

    static function getCorrectName(PDO $dbh, Phone $phone) : string{
      $model = explode(" ", $phone->model);
      if($phone->brand == 'Apple' || $model[0] == $phone->brand){
          $id = $phone->model;
      }else{
          $id = (string)$phone->brand . ' ' . (string)$phone->model;
      }
      return (string)$id;
    }

    static function getPricePhone(PDO $dbh, Phone $phone) : string{
      $stmt = $dbh->prepare('SELECT price FROM phones WHERE id = ?');
      $stmt->execute([$phone->id]);
      $price = $stmt->fetch(PDO::FETCH_OBJ)->price;
      return (string)$price;
    }

    static function getModelPhone(PDO $dbh, Phone $phone) : string{
      $stmt = $dbh->prepare('SELECT model FROM phones WHERE id = ?');
      $stmt->execute([$phone->id]);
      $model = $stmt->fetch(PDO::FETCH_OBJ)->model;
      return (string)$model;
    }

    static function getSellerPhone(PDO $dbh, Phone $phone) : string{
      $stmt = $dbh->prepare('SELECT seller FROM phones WHERE id = ?');
      $stmt->execute([$phone->id]);
      $seller = $stmt->fetch(PDO::FETCH_OBJ)->seller;
      $stmt = $dbh->prepare('SELECT username FROM users WHERE id = ?');
      $stmt->execute([$seller]);
      $seller = $stmt->fetch(PDO::FETCH_OBJ)->username;
      return (string)$seller;
    }

    static function deletePhoneById(PDO $dbh, int $id){
      $stmt = $dbh->prepare('DELETE FROM phones WHERE id = ?');
      $stmt->execute([$id]);
    }

    static function getImageById(PDO $dbh, int $id){
      $stmt = $dbh->prepare('SELECT image FROM phones WHERE id = ?');
      $stmt->execute([$id]);
      $image = $stmt->fetch(PDO::FETCH_OBJ)->image;
      return (string)$image;
    }
    
    static function updateCategory(PDO $dbh, $old_category, $new_category) {
      $stmt = $dbh->prepare('UPDATE phones SET category = ? WHERE category = ?');
      $stmt->execute([$new_category, $old_category]);
    }

    static function updateColor(PDO $dbh, $old_color, $new_color) {
      $stmt = $dbh->prepare('UPDATE phones SET color = ? WHERE color = ?');
      $stmt->execute([$new_color, $old_color]);
    }

    static function updateStorage(PDO $dbh, $old_storage, $new_storage) {
      $stmt = $dbh->prepare('UPDATE phones SET storage = ? WHERE storage = ?');
      $stmt->execute([$new_storage, $old_storage]);
    }

    static function updateCondition(PDO $dbh, $old_condition, $new_condition) {
      $stmt = $dbh->prepare('UPDATE phones SET condition = ? WHERE condition = ?');
      $stmt->execute([$new_condition, $old_condition]);
    }

    static function updateBrand(PDO $dbh, $old_brand, $new_brand) {
      $stmt = $dbh->prepare('UPDATE phones SET brand = ? WHERE brand = ?');
      $stmt->execute([$new_brand, $old_brand]);
    }

    static function updateModel(PDO $dbh, $old_model, $new_model) {
      $stmt = $dbh->prepare('UPDATE phones SET model = ? WHERE model = ?');
      $stmt->execute([$new_model, $old_model]);
    }

    static function updateCamera(PDO $dbh, $old_camera, $new_camera) {
      $stmt = $dbh->prepare('UPDATE phones SET camera = ? WHERE camera = ?');
      $stmt->execute([$new_camera, $old_camera]);
    }

    static function updateCpu(PDO $dbh, $old_cpu, $new_cpu) {
      $stmt = $dbh->prepare('UPDATE phones SET cpu = ? WHERE cpu = ?');
      $stmt->execute([$new_cpu, $old_cpu]);
    }

    static function updateSize(PDO $dbh, $old_size, $new_size) {
      $stmt = $dbh->prepare('UPDATE phones SET size = ? WHERE size = ?');
      $stmt->execute([$new_size, $old_size]);
    }

    static function updateMemory(PDO $dbh, $old_memory, $new_memory) {
      $stmt = $dbh->prepare('UPDATE phones SET memory = ? WHERE memory = ?');
      $stmt->execute([$new_memory, $old_memory]);
    }

    static function updateBattery(PDO $dbh, $old_battery, $new_battery) {
      $stmt = $dbh->prepare('UPDATE phones SET battery = ? WHERE battery = ?');
      $stmt->execute([$new_battery, $old_battery]);
    }
  }