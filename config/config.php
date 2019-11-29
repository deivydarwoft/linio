<?php
namespace config\config;
/**
 * 
 */
class Config
{
	public static function getContextusConfig()
	{
		$body = @file_get_contents('../config/configuration.json');
		// print_r($body);die;
		$data = json_decode($body);
		http_response_code(200); // Returns 200 OK to the server

		// const SC_API_URL = 'https://sellercenter-api.linio.com.mx/';
		// const SC_API_USER = 'pruebaelapi@linio.com';
		// const SC_API_KEY = 'b04291a074c06a71ee4f29e2a512a4a1ddc5a231';
		return $data;
	}
}

