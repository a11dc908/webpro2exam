<?php
include_once('product.php');
include_once('sale.php');


class SalesController {
    public function index() {
        // 何かの処理...

        $sales = Sale::all();	    
        // $model_data = array('テレビ', '掃除機', '洗濯機');
        include('views/sales/index.php');
    }

    public function newSale($product_id) {
    	include('header.php');	
    	$product = Product::load($product_id);
    	include('views/sales/new.php');	
    }

    public function createSale($product_id, $qty) {
    	try {
		    $pdo = new PDO('mysql:host=127.0.0.1;dbname=webpro2examdb;charset=utf8', 'root', '');
		    $stmt = $pdo->prepare('SELECT a.sales_at,a.product_id,a.name,SUM(a.quantity),a.price FROM (SELECT *  FROM products INNER JOIN (SELECT product_id,sales_at, quantity FROM sales)f  ON products.id = f.product_id) as a GROUP BY a.product_id ASC');	        

	        if ($stmt) {
	        	$date = date('Y-m-d H:i:s');
			    $stmt->bindValue(':PRODUCT_ID',   $product_id);
			    $stmt->bindValue(':SALES_AT',   $date, PDO::PARAM_STR);
	        	$stmt->bindValue(':QUANTITY',   $qty);
			    if ($stmt->execute()) {
			        /* 略 */
			        header( 'Location: ./sales_controller.php' ) ;
			    } else {
			        var_dump($stmt->errorInfo());
			    }
			} else {
			    var_dump($pdo->errorInfo());
			}
		} catch (PDOException $e) {
		    var_dump($e->getMessage());
		}

    }
}

$controller = new SalesController();


if (isset($_GET['product']) && !empty($_GET['product'])) {
    $controller->newSale($_GET['product']);
}else if(isset($_GET['create']) && !empty($_GET['create'])){
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	//echo $id . " qty:" . $qty;
	$controller->createSale($id, $qty);
}else{
	$controller->index();
}
