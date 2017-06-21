<?php

class Product_Blood_Model_Blood extends Mage_Core_Model_Abstract
{
    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('product_blood/blood');
    }

    /**
     * @param $slug
     * @return $this
     */
    public function loadBySlug($slug)
    {
        $resource = $this->_getResource();
        $resource->loadBySlug($slug, $this);

        return $this;
    }
}