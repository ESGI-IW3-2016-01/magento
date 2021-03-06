<?php

class Product_Blood_Block_Blood extends Mage_Core_Block_Template
{
    public function methodFromTheBlock()
    {
        return 'this is a method from the block';
    }

    public function helloWorld()
    {
        return 'hello world !';
    }

    public function getBloodProducts()
    {
        $blood = Mage::getModel('product_blood/blood')
            ->getCollection()
            ->addIsActiveFilter();

        return $blood;
    }
    
}