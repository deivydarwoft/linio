<?php 
namespace models\LinioOrder;
use \Datetime;
use models\ContextusClient\ContextusClient;
/**
 * 
 */
class LinioOrder
{
	public function getOrderById($xOrderId)
    {
    	if ($xOrderId) {
			$xMethod = 'GET';
    		$xAction = 'GetOrder';
    		$xSearchBy = 'OrderId';
    		$xSearch = $xOrderId;
    		$xProduct = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch);
    		$xResponse[] = $xProduct->SuccessResponse->Body->Orders->Order;
        	return $xResponse;
        }
    }
    public function getMultipleOrderItems($aOrdersIds)
    {
        if ($xOrderId) {
            $xMethod = 'GET';
            $xAction = 'GetMultipleOrderItems';
            $xSearchBy = 'OrderIdList';
            $xSearch = $xOrderId;
            $xProduct = ContextusClient::myCurl($xMethod, $xAction, $xSearchBy, $xSearch);
            $xResponse[] = $xProduct->SuccessResponse->Body->Orders->Order;
            return $xResponse;
        }
    }

}