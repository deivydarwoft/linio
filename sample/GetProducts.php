<?php
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;

// getProducts
$response = LinioProducts::getProducts();

foreach ($response as $product) {
	echo "Name: ".$product->getName().", SellerSku: ".$product->getSellerSku().", Price: ".$product->getPrice();
	echo "<br>";
}