<?php

include_once('product.php');

class ProductsController {
    public function index() {
        // 何かの処理...

        	    
	    $products = Product::all();	    

        // $model_data = array('テレビ', '掃除機', '洗濯機');
        include('header.php');
        include('views/products/index.php');
    }
}

$controller = new ProductsController();
$controller->index();

?>