<?php
require_once './lib/ContextusAPIWrapper.php';
require_once './models/ContextusClient.php';
require_once './models/LinoProducts.php';


use RocketLabs\SellerCenterSdk\Core\Client;
use RocketLabs\SellerCenterSdk\Core\Configuration;
use RocketLabs\SellerCenterSdk\Core\Request\GenericRequest;
use RocketLabs\SellerCenterSdk\Core\Response\SuccessResponseInterface;
use RocketLabs\SellerCenterSdk\Core\Response\getHead;
use RocketLabs\SellerCenterSdk\Core\Response\getMessage;
use RocketLabs\SellerCenterSdk\Core\call;
use models\ContextusClient\ContextusClient;
use models\LinoProducts\LinoProducts;



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
// print_r($products[0]['images'][0]['permalink']);

// $client = new ContextusClient();

// $client->clientConfiguration();

// $client = Client::create(new Configuration(SC_API_URL, SC_API_USER, SC_API_KEY));

// $response = \RocketLabs\SellerCenterSdk\Endpoint\Endpoints::product()
//     ->getProducts()
//     ->setLimit(3)
//     ->build()->call($client);
// if ($response instanceof SuccessResponseInterface) {
//     print_r($response);
// }

foreach ($products as $oProduct) {
	$oProducts[] = new LinoProducts( $oProduct);
}
$response = LinoProducts::createProduct($oProducts);
print_r($response);die;
// if ($response instanceof SuccessResponseInterface) {
// 	printf("Feed has been created. Feed id = %s\n", $response->getHead()['RequestId']);
// } else {
// 	/** @var $response ErrorResponse */
// 	printf("Error %s\n", $response->getMessage());
// }


// print_r($oProducts);die;