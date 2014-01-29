<?php

class Product {

    private $id;
    private $name;
    private $price;

    public function __construct($params) {        
        $this->id         = isset($params['id']) ? $params['id'] : null;
        $this->name = isset($params['name']) ? $params['name'] : null;
        $this->price   = isset($params['price']) ? $params['price'] : null;
    }


    public static function all() {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=webpro2examdb;charset=utf8;', 'root', '');
        $stmt = $pdo->query('SELECT * FROM Products');

        $products = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product($row);
            array_push($products, $product);
        }

        return $products;
    }

    public static function load($id) {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=webpro2examdb;charset=utf8;', 'root', '');
        $stmt = $pdo->query('SELECT * FROM Products WHERE id=' . $id);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $product = new Product($row);
        
        return $product;
    }


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

}
