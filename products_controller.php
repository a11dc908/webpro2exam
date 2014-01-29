<?php
require_once('other/utils.php');
require_once('other/pdo.php');
require_once('other/even.php');

$res = $pdo->prepare('select count(*) from sales');
$res->execute();
$result = $res->fetchAll();

foreach ($result as $key1=>$value1){
                foreach ($value1 as $key=>$value){
                        if($key=="count(*)"){
                                $id=$value;
                                $id++;
                                }
                }
}


$product_id = $_GET['id'];

$time = time() + 9*3600;  //GMTとの時差9時間を足す
$sales_at=gmdate("Y/m/d H:i:s ", $time);
$quantity=$_POST["each"];
if(!is_integer($quantity)){$quantity=SBC_DBC($quantity);}
echo "ID is".$id.        ".    商品IDは".$product_id.".  sales time is".$sales_at.".  売った数は".$quantity;


if($quantity==null && $quantity==0){redirect_to('sales.php');}
else {

echo "ID is".$id.        ".    商品IDは".$product_id.".  sales time is".$sales_at.".  売った数は".$quantity;
$salesdata = $pdo -> prepare("INSERT INTO sales (ID,product_id,sales_at,quantity) VALUES (:ID,:product_id,:sales_at,:quantity)");

$salesdata->bindParam(':ID',                                 $id,                                PDO::PARAM_STR);
$salesdata->bindParam(':product_id',        $product_id,        PDO::PARAM_STR);
$salesdata->bindParam(':sales_at',                $sales_at,                 PDO::PARAM_STR);
$salesdata->bindParam(':quantity',                $quantity,                PDO::PARAM_STR);
$salesdata->execute();

$salesdata=null;

redirect_to('sales.php');
}

?>