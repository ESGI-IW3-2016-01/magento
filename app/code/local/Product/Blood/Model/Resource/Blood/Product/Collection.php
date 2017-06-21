<?php

class Product_Blood_Model_Resource_Blood_Product_Collection extends Mage_Catalog_Model_Resource_Product_Collection
{
    protected $_joinedFields = false;

    public function joinFields()
    {
        if (!$this->_joinedFields) {
            $this->getSelect()->join(
                array('related' => $this->getTable('blood/blood_product')),
                'related.product_id = e.entity_id',
                array('position')
            );
            $this->_joinedFields = true;
        }
        return $this;
    }

    public function addBloodFilter($blood)
    {
        if ($blood instanceof Product_Blood_Model_Blood) {
            $blood = $blood->getId();
        }
        if (!$this->_joinedFields) {
            $this->joinFields();
        }
        $this->getSelect()->where('related.blood_id = ?', $blood);
        return $this;
    }
}