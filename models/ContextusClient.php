<?php 
namespace models\ContextusClient;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';
use RocketLabs\SellerCenterSdk\Core\Client;
use RocketLabs\SellerCenterSdk\Core\Configuration;
use \Datetime;
use config\config\Config;

/**
 * 
 */
class ContextusClient
{
	protected $apiURL;
	protected $apiUserID;
	protected $apiKey;

	public function __construct($apiURL, $apiUserID , $apiKey)
	{
		$this->apiURL = $apiURL;
		$this->apiUserID = $apiUserID;
		$this->apiKey = $apiKey;
	}
    /**
     * SDK for
     */
	public function clientConfiguration()
	{
        $xContextusClient = Config::getContextusConfig();
        
        $xContextusClient = new ContextusClient($xContextusClient->apiURL, $xContextusClient->apiUser, $xContextusClient->apiKey);
		
		try {
			return Client::create(new Configuration($xContextusClient->apiURL, $xContextusClient->apiUserID, $xContextusClient->apiKey));
		} catch (Exception $e) {
			print_r($e);
		}	
	}
    /**
    * HTTP request directed to an endpoint. Depending on what you want to achieve, you will either perform an HTTP request with a GET or POST verb.
    * @param   String   $xMethod        method.
    * @param   String   $xAction        Name of the function that is to be called.
    * @param   String   $xSearchBy      Camp.
    * @param   String   $xSearch        Value.
    * @param   String   $xBody          The body transmitted by the POST.
    * @return  [Order] 
    */
	public static function myCurl($xMethod= 'GET', $xAction, $xSearchBy = null, $xSearch = null, $xBody = '' )
    {
        $xContextusClient = Config::getContextusConfig();
        
		$xContextusClient = new ContextusClient($xContextusClient->apiURL, $xContextusClient->apiUser, $xContextusClient->apiKey);
        // Pay no attention to this statement.
        // It's only needed if timezone in php.ini is not set correctly.
        // date_default_timezone_set<("UTC");

        // The current time. Needed to create the Timestamp parameter below.
        $now = new \DateTime();

        // The parameters for our GET request. These will get signed.
        $parameters = array
        ( 
            // The user ID for which we are making the call.
            'UserID' => $xContextusClient->apiUserID, 
            // The API version. Currently must be 1.0
            'Version' => '1.0',
            // The API method to call.
            'Action' => $xAction,
            // The format of the result.
            // 'Format' => 'XML',
            'Format' => 'JSON',
            
            // The current time formatted as ISO8601
            'Timestamp' => $now->format(DateTime::ISO8601)
        );
        // For filtering.
        if ($xSearchBy) {
            $parameters += [$xSearchBy => $xSearch];
        }
        // Sort parameters by name.
        ksort($parameters);
        $encoded = array();

        foreach ($parameters as $name => $value)
        {
            $encoded[] = rawurlencode($name) . '=' . rawurlencode($value);
        }
        // Concatenate the sorted and URL encoded parameters into a string.
        $concatenated = implode('&', $encoded);

        // The API key for the user as generated in the Seller Center GUI.
        // Must be an API key associated with the UserID parameter.
        $api_key = $xContextusClient->apiKey;
        // Compute signature and add it to the parameters.
        $parameters['Signature'] =
        rawurlencode(hash_hmac('sha256', $concatenated, $api_key, false));  

        $url = $xContextusClient->apiURL;
        // Build Query String
        $queryString = http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);

        // Open cURL connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url."?".$queryString);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xBody);

        $data = curl_exec($ch);
        $code = curl_error($ch);
        // Close Curl connection
        curl_close($ch);

        //Para ver la respuesta
        return json_decode($data);
    }
}