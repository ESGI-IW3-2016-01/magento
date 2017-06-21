<?php

class Product_Blood_Model_Resource_Blood_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('product_blood/blood');
    }

    /**
     * Filter collection by status
     *
     * @return Product_Blood_Model_Resource_Blood_Collection
     */
    public function addIsActiveFilter()
    {
        $this->addFieldToFilter('is_active', 1);

        return $this;
    }

}