<?php
namespace TrainingAnkit\AssignProduct\Cron;

class Test
{
	public function execute()
	{
		//Get Last three day latest product
		    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		    $productCollectionFactory = $objectManager->get('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
		    $to = date("Y-m-d h:i:s"); // current date
		    $from = strtotime('-3 day', strtotime($to));
		    $from = date('Y-m-d h:i:s', $from);
		    $collection = $productCollectionFactory->create();
			$collection->addAttributeToSelect('*');
			$collection->addFieldToFilter('created_at', array('from'=>$from, 'to'=>$to))->addAttributeToSort('created_at', 'DESC');
			$category_ids = array('7');
			$CategoryLinkRepository = $objectManager->get('\Magento\Catalog\Api\CategoryLinkManagementInterface');
			$i = 0;
			foreach($collection as $product){
				if($i<=9){
	                $CategoryLinkRepository->assignProductToCategories($product->getSku(), $category_ids);
	                 echo $i++;
	            }
                
        	} 
	}
}
