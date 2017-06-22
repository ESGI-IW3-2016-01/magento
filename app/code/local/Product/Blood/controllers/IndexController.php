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
        
        $associatedProducts = $product->getSelectedProductsCollection()
            ->addAttributeToFilter('visibility', array('neq' => Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE))
            ->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
            ->addAttributeToSelect('image')
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('url_path')
            ->addAttributeToSelect('name');

        Mage::register('product', $product);
        Mage::register('associatedProducts', $associatedProducts);

        $this->getLayout()->getBlock('head')->setTitle($this->__('Blood Product Details'));
        $this->renderLayout();

    }
}