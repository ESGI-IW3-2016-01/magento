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
     * @var string
     */
    protected $_productInstance = null;

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

    public function getProductInstance()
    {
        if (!$this->_productInstance) {
            $this->_productInstance = Mage::getSingleton('blood/blood_product');
        }
        return $this->_productInstance;
    }

    protected function _afterSave()
    {
        $this->getProductInstance()->saveBloodRelation($this);

        return parent::_afterSave();
    }

    public function getSelectedProducts()
    {
        if (!$this->hasSelectedProducts()) {
            $products = array();
            foreach ($this->getSelectedProductsCollection() as $product) {
                $products[] = $product;
            }
            $this->setSelectedProducts($products);
        }
        return $this->getData('selected_products');
    }

    public function getSelectedProductsCollection()
    {
        $collection = $this->getProductInstance()->getProductCollection($this);

        return $collection;
    }
}