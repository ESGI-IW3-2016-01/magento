<?php

class Product_Blood_Model_Blood_Product extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('blood/blood_product');
    }

    public function saveBloodRelation($blood)
    {
        $data = $blood->getProductsData();
        if (!is_null($data)) {
            $this->_getResource()->saveBloodRelation($$blood, $data);
        }
        return $this;
    }

    public function getProductCollection($blood)
    {
        $collection = Mage::getResourceModel('blood/blood_product_collection')
            ->addBloodFilter($$blood);
        return $collection;
    }
}