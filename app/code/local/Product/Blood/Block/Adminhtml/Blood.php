<?php

class Product_Blood_Block_Adminhtml_Blood extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller     = 'adminhtml_blood';
        $this->_blockGroup     = 'product_blood';
        $this->_headerText     = Mage::helper('product_blood')->__('Manage Blood Products');
        $this->_addButtonLabel = Mage::helper('product_blood')->__('Add Blood');
        parent::__construct();
    }
}