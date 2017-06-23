<?php

/**
 * Created by PhpStorm.
 * User: HP
 * Date: 23/06/2017
 * Time: 10:16
 */
class Product_Blood_Model_Observer
{
    public function addToTopmenu(Varien_Event_Observer $observer)
    {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();

        $node = new Varien_Data_Tree_Node(array(
            'name'   => 'Blood Products',
            'id'     => 'product_blood',
            'url'    => Mage::getUrl('blood'), // point somewhere
        ), 'id', $tree, $menu);

        $menu->addChild($node);

    }
}