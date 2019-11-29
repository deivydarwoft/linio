<?php
require_once '../models/LinioProducts.php';
require_once '../models/ContextusClient.php';
require_once '../lib/ContextusAPIWrapper.php';


use RocketLabs\SellerCenterSdk\Core\Response\ErrorResponse;
use models\ContextusClient\ContextusClient;
use models\LinioProducts\LinioProducts;

$APIWrapper = new \ContextusAPIWrapper\ContextusAPIWrapper();
$APIWrapper->setUrl('https://www.theunclewines.com.ar');
$APIWrapper->setClientId('theunclewines');
$APIWrapper->setClientSecret('7cc33b81f471212c2a6a975c589fda0b5507a0399b4546e0f9e19777cf9fde5a');
$APIWrapper->setImagesBasepath('https://www.theunclewines.com.ar/images/products/1602/');

$token = $APIWrapper->getLoginToken();

// parameters example for filtering products
$params = [];
$params['name'] = '';
$params['price_min'] = 0;
$params['price_max'] = 99999999;
$params['sort_key'] = '09';
$params['sort_direction'] = 'asc';
$params['paging_offset'] = 0;
$params['paging_limit'] = 100;

// get the products recusrsively from the API
$products = $APIWrapper->getClientProducts($token, $params);

foreach ($products as $oProduct) {
	$oProducts[] = new LinioProducts( $oProduct);
}
// Update products
$response = LinioProducts::updateProducts($oProducts);
if ($response instanceof ErrorResponse) {
	/** @var ErrorResponse $response */
	printf("ERROR !\n");
	printf("%s\n", $response->getMessage());
} else {
	printf("The feed `%s` has been updated.\n", $response->getFeedId());
}
?>