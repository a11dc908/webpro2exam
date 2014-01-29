<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=webpro2exam;charset=utf8;', 'root', '');

   }    
   catch (PDOException $e) {
    var_dump($e->getMessage());
}