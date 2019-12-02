<?php 
namespace models\LinioWebhook;
require_once '../models/LinioProducts.php';
require_once '../models/LinioOrder.php';

use \Datetime;
use models\ContextusClient\ContextusClient;
use models\LinioOrder\LinioOrder;
use models\LinioProducts\LinioProducts;
/**
 *  Find below all the payload definition for all entities.
 */
class LinioWebhook
{
	/** You must configure this function as an ENDPOINT in order to work 
     * (i.e. Codeigniter routing).
     * 
     */
    /**
	 * @return 	[Products] 
	 */
    public function productCreated() {

    	// $body = @file_get_contents('php://input');
    	$body = @file_get_contents('../JSONtests/productCreated.json'); // This is a test, ignore for production
    	$data = json_decode($body);
        http_response_code(200); // Returns 200 OK to the server
        if ($data) {
        	return LinioProducts::getProductsById($data->payload->SellerSkus);
    	}
        
    }

	/** You must configure this function as an ENDPOINT in order to work 
     * (i.e. Codeigniter routing).
     * 
     */
	/**
	 * @return 	[Products] 
	*/
	public function productUpdated() {

		// $body = @file_get_contents('php://input');
		$body = @file_get_contents('../JSONtests/productUpdated.json'); // This is a test, ignore for production
		$data = json_decode($body);
        http_response_code(200); // Returns 200 OK to the server
        if ($data) {
        	return LinioProducts::getProductsById($data->payload->SellerSkus);
        }
    }
    
    /** You must configure this function as an ENDPOINT in order to work 
     * (i.e. Codeigniter routing).
     * 
     */
    /**
     * @return  [Products] 
    */
    public function productChanged() {

    	// $body = @file_get_contents('php://input');
		$body = @file_get_contents('../JSONtests/productChanged.json'); // This is a test, ignore for production

    	$data = json_decode($body);
        http_response_code(200); // Returns 200 OK to the server
        
        if ($data) {
        	return LinioProducts::getProductsById($data->payload->SellerSkus);
        }
    }

    /** You must configure this function as an ENDPOINT in order to work 
     * (i.e. Codeigniter routing).
     * 
     */
    /**
     * @return  [Order] 
    */
    public function orderCreated() {

    	$body = @file_get_contents('php://input');
		$body = @file_get_contents('../JSONtests/orderCreated.json'); // This is a test, ignore for production

    	$data = json_decode($body);
        http_response_code(200); // Returns 200 OK to the server
    
        if ($data) {
        	return LinioOrder::getOrderById($data->payload->OrderId);
        }
    }

    /** You must configure this function as an ENDPOINT in order to work 
     * (i.e. Codeigniter routing).
     * 
     */
    /**
     * @return  [Order] 
    */
    public function orderStatusChanged() {

    	$body = @file_get_contents('php://input');
		$body = @file_get_contents('../JSONtests/orderChanged.json'); // This is a test, ignore for production
    	$data = json_decode($body);
        http_response_code(200); // Returns 200 OK to the server
        
        if ($data) {
        	return LinioOrder::getOrderById($data->payload->OrderId);
        }
    }
}