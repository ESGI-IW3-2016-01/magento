<?php

class Product_Blood_Block_Adminhtml_Blood_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('blood_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('product_blood')->__('Blood Information'));
    }
}