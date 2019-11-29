<?php
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';

use models\LinioProducts\LinioProducts;
use models\ContextusClient\ContextusClient;

// getBrands
$response = LinioProducts::getBrands();

if ($response instanceof ErrorResponse) {
	printf("ERROR !\n");
	printf("%s\n", $response->getMessage());
} else {
	$brands = $response->getBrands();
	printf("% 10s % 16s %s\n", 'BrandId', 'GlobalIdentifier', 'BrandName');
	/** @var Brand $brand */
	foreach ($brands as $brand) {
		printf(
			"% 10d % 16s %s\n",
			$brand->getId(),
			$brand->getGlobalIdentifier(),
			$brand->getName()
		);
	}
}