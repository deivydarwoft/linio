<?php 
namespace models\LinioSeller;

use \Datetime;
use models\ContextusClient\ContextusClient;

/**
 * Seller. 
 */
class LinioSeller
{
	/**
	 * Returns sales and order metric for a specified period. The returned metrics are not computed in real-time, but are pre-calculated at regular intervals.
	 * @return 	Metrics 	
	*/
	public function getMetrics()
	{
		$xMethod = 'GET';
		$xAction = 'GetMetrics';
		$xSearchBy = null;
		$xSearch = null;
		$xCurlResponse = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch);
		$xResponse[] = $xCurlResponse->SuccessResponse->Body;
		return $xResponse;
	}
	/**
	 * Returns sales and order metric for a specified period.
	 * @param 	Date 	$xCreatedAfter	
	 * @return 	PayoutStatus 	
	*/
	public function getPayoutStatus($xCreatedAfter)
	{

		$xMethod = 'POST';
		$xAction = 'GetPayoutStatus';
		$xSearchBy = 'CreatedAfter';
		$xSearch = $xCreatedAfter;
		$xBody='';
		$xCurlResponse = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch, $xBody);
		$xResponse[] = $xCurlResponse->SuccessResponse->Body;
		return $xResponse[0]->SuccessResponse->Body;
	}
	/**
	 * Returns sales and orders metrics for a specified period.
	 * @return 	[Products, Orders, OrdersItemsPending, AccountHealth]
	*/
	public function getStatistics()
	{
		$xMethod = 'GET';
		$xAction = 'GetStatistics';
		$xSearchBy = null;
		$xSearch = null;
		$xCurlResponse = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch);
		$xResponse[] = $xCurlResponse->SuccessResponse->Body;
		return $xResponse;
	}
	/**
	 * This call will update a seller email address for the seller of the user making the call.
	 * @param 	String 	$xEmail	
	 * @return 	 	
	*/
	public function sellerUpdate($xEmail)
	{

		$xBody = '<?xml version="1.0" encoding="UTF-8" ?>
		<Request>
		<Seller>
			<Email>'.$xEmail.'</Email>
		</Seller>
		</Request>';
		$xMethod = 'POST';
		$xAction = 'SellerUpdate';
		$xSearchBy = null;
		$xSearch = null;
		$xCurlResponse = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch, $xBody);
		$xResponse[] = $xCurlResponse->SuccessResponse->Body;
		return $xResponse;
	}

}