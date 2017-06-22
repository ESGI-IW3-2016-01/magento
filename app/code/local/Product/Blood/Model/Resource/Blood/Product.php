<?php

class Product_Blood_Model_Resource_Blood_Product extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('product_blood/blood_product', 'rel_id');
    }

    public function saveBloodRelation($blood, $data)
    {
        if (!is_array($data)) {
            $data = array();
        }
        $deleteCondition = $this->_getWriteAdapter()->quoteInto('blood_id=?', $blood->getId());
        $this->_getWriteAdapter()->delete($this->getMainTable(), $deleteCondition);

        foreach ($data as $productId => $info) {
            $this->_getWriteAdapter()->insert($this->getMainTable(), array(
                'blood_id' => $blood->getId(),
                'product_id' => $productId,
                'position' => @$info['position']
            ));
        }
        return $this;
    }
}