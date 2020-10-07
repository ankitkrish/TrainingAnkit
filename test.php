<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$obj = $bootstrap->getObjectManager();
$storeManager = $obj->get('\Magento\Store\Model\StoreManagerInterface');
$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();  
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

$product_id = 2;
$product = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
$productRepository = $objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface');

$StockState = $objectManager->get('\Magento\CatalogInventory\Api\StockStateInterface');

$yourQty='999';
$product->setStockData(['qty' => $yourQty, 'is_in_stock' => 1]);
$product->setQuantityAndStockStatus(['qty' => $yourQty, 'is_in_stock' => 1]);
$product->save();
