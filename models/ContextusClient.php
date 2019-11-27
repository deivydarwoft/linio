<?php 
namespace models\ContextusClient;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
use RocketLabs\SellerCenterSdk\Core\Client;
use RocketLabs\SellerCenterSdk\Core\Configuration;

/**
 * 
 */
class ContextusClient
{
	public function clientConfiguration()
	{
		try {
			return Client::create(new Configuration(SC_API_URL, SC_API_USER, SC_API_KEY));
		} catch (Exception $e) {
			print_r($e);
		}	
	}
}