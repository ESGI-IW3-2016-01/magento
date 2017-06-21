<?php

class Product_Blood_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function viewAction()
    {
        $this->loadLayout();

        $slug = $this->getRequest()->getParam('slug');

        if(empty($slug)) {
            return $this->norouteAction();
        }

        $model = Mage::getModel('product_blood/blood');
        $product = $model->loadBySlug($slug);
        if(empty($product->getData())) {
            return $this->norouteAction();
        }
        
        Mage::register('product', $product);

        $this->getLayout()->getBlock('head')->setTitle($this->__('Blood Product Details'));
        $this->renderLayout();

    }
}