<?php

include_once('product.php');

class Sale {

    private $id;
    private $product_id;
    private $sales_at;
    private $quantity;
    private $product;

    public function __construct($params) {
        $this->id         = isset($params['id']) ? $params['id'] : null;
        $this->product_id = isset($params['product_id']) ? $params['product_id'] : null;
        $this->sales_at   = isset($params['sales_at']) ? $params['sales_at'] : null;
        $this->quantity   = isset($params['quantity']) ? $params['quantity'] : null;
    }


    public static function all() {        
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=webpro2examdb;charset=utf8;', 'root', '');
        $stmt = $pdo->query('SELECT * FROM Sales');

        $sales = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sale = new Sale($row);
            $product = Product::load($sale->getProductId());
            $sale->setProduct($product);
            array_push($sales, $sale);
        }

        return $sales;
    }

    public function save() {
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function setProduct($product){
        $this->product = $product;
    }

    public function getProduct(){
        return $this->product;
    }

    public function setProductId($product_id) {
        $this->product_id = $product_id;
    }

    public function getSalesAt() {
        return $this->sales_at;
    }

    public function getSalesAtFormatted() {
        return $this->sales_at;
    }

    public function setSalesAt($sales_at) {
        $this->sales_at = $sales_at;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

}
