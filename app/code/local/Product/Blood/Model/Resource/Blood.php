<?php

class Product_Blood_Model_Resource_Blood extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('product_blood/blood', 'entity_id');
    }

    /**
     * Perform actions before object save
     *
     * @param Varien_Object $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {

        $slug = Mage::getModel('catalog/product_url')->formatUrlKey($object->getName());
        if ($this->slugNotExist($slug, $object->getId())) {
            $object->setSlug($slug);
        }

        parent::_beforeSave($object);

        return $this;
    }

    /**
     * Check if slug already exist
     *
     * @param String
     * @param Integer
     * @return Mage_Eav_Model_Attribute_Data_Boolean
     */
    private function slugNotExist($slug, $id) {
        $adapter = $this->_getReadAdapter();
        $select  = $adapter->select()
            ->from($this->getTable('product_blood/blood'))
            ->where('slug = ?', $slug)
            ->where('entity_id != ?', $id);
        if(empty($adapter->fetchCol($select))){
            return true;
        }
        return false;
    }

    public function loadBySlug($slug, $object) {
        $adapter = $this->_getReadAdapter();
        $select  = $adapter->select()
            ->from($this->getTable('product_blood/blood'))
            ->where('slug = ?', $slug);
        
        $result = $adapter->fetchRow($select);
        if (empty($result)) {
            return false;
        }
        $object->setData($result);
    }
}