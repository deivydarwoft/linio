<?php 
namespace models\LinoProducts;

use RocketLabs\SellerCenterSdk\Core\Client;
use RocketLabs\SellerCenterSdk\Core\Request\GenericRequest;
use RocketLabs\SellerCenterSdk\Core\Response\SuccessResponseInterface;
use RocketLabs\SellerCenterSdk\Core\Response\getMessage;
use RocketLabs\SellerCenterSdk\Endpoint\Endpoints;
use \Datetime;
use models\ContextusClient\ContextusClient;
// date_default_timezone_set('America/Argentina/Buenos_Aires');
/**
 * 
 */
class LinoProducts
{
	/**
	 * Para construir el objeto necesitamos algunos campos obligatorios que no vienen actualmente desde contextus, por lo que se han colocado manualment
	 */
	function __construct($oContextus)
	{
		$this->sellerSku = $oContextus['id']; // String. A unique identifier for the product within the SellerCenter instance that is to be added to the system. This identifier is usually freely assigned. Mandatory

		$this->parentSku = null; //String. The unique identifier of a product with which this product should be associated. [Free nomenclature ParentSku feature enabled] If ParentSku is provided than it will pick the defined ParentSku otherwise it will use SellerSku of the first variation. Optional

		$this->status = 'active'; //String.  One of the following values: 'active', 'inactive' or 'deleted'. Optional, defaults to 'active'.

		$this->name = $oContextus['name']; //String.  The name of the product as shown to the end-user. Must be between 2 to 255 characters. Mandatory unless the Primary Category is configured for Automatic Nomenclature, in which case "Name" is optional and will be ignored. The products belonging to such categories get the product name automatically generated from some pattern, e.g. "[Brand] / [Model]"

		$this->variation = null; //String. If a product is available in multiple variations (e.g., colors or size), this is the value of the variation. E.g., if the product is a jacket that comes in different sizes, this would be the size of the jacket's variation that is added with the call (e.g., 'Extra Small').

		$this->primaryCategory = 18784;  //Integer. The ID of the primary category for his product. To get the ID for each of the system's categories call GetCategoryTree. Mandatory, e.g. 18784 "Mascotas"

		$this->categories = null; //String. A comma-separated list of one to thee sub-categories to which the product belongs. Each of the given sub-categories must descend from the category specified by the PrimaryCategory parameter. Optional

		$this->browseNodes = null; //String. A comma-separated list of one or two additional categories that are not necessarily related to the PrimaryCategory. Optional

		$this->description = 'Description'; //String. The description of the product, as shown to the end-user. 6 to 25000 characters. Embedding certain HTML tags is allowed, but must be escaped as character data (see below). Mandatory

		$this->brand = 'marca'; //String. The brand name of the product. Mandatory

		$this->price = $oContextus['price']['original']; //Decimal. The product's price. Not really a Double, but a Decimal. Mandatory

		$this->salePrice = $oContextus['price']['sale']; //Decimal. The price for the product while it is on sale neeeds to be lower then the Price. If SalePrice is specified, either SaleStartDate or SaleEndDate must be given; vice versa, if at least one of SaleStartDate or SaleEndDate is specified, SalePrice is mandatory.

		$this->saleStartDate = new DateTime('now'); //DateTime. Time and date for when the product goes on sale. If passed in, SalePrice becomes mandatory.

		$this->saleEndDate = (new DateTime('now'))->modify('+5 day'); //DateTime. Time and date for when the product goes on sale. If passed in, SalePrice becomes mandatory.

		$this->taxClass = null; //String.  The taxation class the product belongs to. The available tax classes are dependent on the specific installation the call is executed against. Optional

		$this->shipmentType = null; //String. Indicates whether the product is shipped direcly upon receipt ('crossdocking') or is drop shipped ('dropshipping'). Which shipment types are permissible depends on what is set up for a specific seller. Optional

		$this->productId = null; //String.  A harmonized code for the product, such as Universal Product Code (UPC), International Article Number (EAN), Global Trade Item Number (GTIN) or International Standard Book Number (ISBN). Optional

		$this->condition = null; //String. Indicates whether the product is new or used. One of 'new', 'used' or 'refurbished'. Optional

		$this->productData = array(); //Subsection. Additional product attributes, depends on the primary category. Optional

		$this->quantity = null; //Integer. The current level of inventory for this product. Optional

		$this->image = $this->setImages($oContextus);
	}

	private function setImages($oContextus)
	{
		// print_r($oContextus);die;
		$aImages = [];
		if ($oContextus) {
			foreach ($oContextus['images'] as $aImage) {
				$aImages[] = $aImage['permalink'];
			}
		}
		
		return $aImages;
	}
	public function createProduct($oProducts)
	{
		try {

			foreach ($oProducts as  $oProduct) {
				$productCollectionRequest = Endpoints::product()->productCreate();
				$productCollectionRequest->newProduct()
				->setSellerSku($oProduct->sellerSku)
				->setParentSku($oProduct->parentSku)
				->setStatus($oProduct->status)
				->setName($oProduct->name)
				->setVariation($oProduct->variation)
				->setPrimaryCategory($oProduct->primaryCategory)
				->setCategories($oProduct->categories)
				->setBrowseNodes($oProduct->browseNodes)
				->setDescription($oProduct->description)
				->setBrand($oProduct->brand)
				->setPrice($oProduct->price)
				->setSalePrice($oProduct->salePrice)
				->setSaleStartDate($oProduct->saleStartDate)
				->setSaleEndDate($oProduct->saleEndDate)
				->setTaxClass($oProduct->taxClass)
				->setShipmentType($oProduct->shipmentType)
				->setProductId($oProduct->productId)
				->setCondition($oProduct->condition)
				->setProductData($oProduct->productData)
				->setQuantity($oProduct->quantity);
			}
			$client = ContextusClient::clientConfiguration();
			$response = $productCollectionRequest->build()->call($client);
			if ($response instanceof SuccessResponseInterface) {
				foreach ($oProducts as $oProduct) {
					if (isset($oProduct->image) AND !empty($oProduct->image)) {

						Endpoints::product()->image($oProduct->sellerSku)->addImage($oProduct->image[0])->build()->call($client);
					}
				}
				return $response;
			}else{
				throw new Exception($response->getMessage(), 1);		
			} 	
		} catch (Exception $e) {
			print_r($e);
		}
	}
	public function updateProduct($oProducts)
	{
		try {
			foreach ($oProducts as  $oProduct) {
				$productCollectionRequest = Endpoints::product()->productUpdate();

				$productCollectionRequest
				->updateProduct($oProduct->sellerSku)
				->setParentSku($oProduct->parentSku)
				->setStatus($oProduct->status)
				->setName($oProduct->name)
				->setVariation($oProduct->variation)
				->setPrimaryCategory($oProduct->primaryCategory)
				->setCategories($oProduct->categories)
				->setBrowseNodes($oProduct->browseNodes)
				->setDescription($oProduct->description)
				->setBrand($oProduct->brand)
				->setPrice($oProduct->price)
				->setSalePrice($oProduct->salePrice)
				->setSaleStartDate($oProduct->saleStartDate)
				->setSaleEndDate($oProduct->saleEndDate)
				->setTaxClass($oProduct->taxClass)
				->setShipmentType($oProduct->shipmentType)
				->setProductId($oProduct->productId)
				->setCondition($oProduct->condition)
				->setProductData($oProduct->productData)
				->setQuantity($oProduct->quantity);
			}
			$client = ContextusClient::clientConfiguration();
			return  = $productCollectionRequest->build()->call($client);

		} catch (Exception $e) {
			print_r($e);
		}
	}
	public function getCategoryTree()
	{
		$client = ContextusClient::clientConfiguration();
		return Endpoints::product()->getCategoryTree()->call($client);
		
	}
}