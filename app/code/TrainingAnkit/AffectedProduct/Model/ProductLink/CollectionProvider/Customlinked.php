<?php
namespace TrainingAnkit\AffectedProduct\Model\ProductLink\CollectionProvider;

class Customlinked
{
    public function getLinkedProducts($product)
    {
        return $product->getCustomlinkedProducts();
    }
}
