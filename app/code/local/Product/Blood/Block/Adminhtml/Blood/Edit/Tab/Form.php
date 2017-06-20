<?php

class Product_Blood_Block_Adminhtml_Blood_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('blood_form', array('legend' => Mage::helper('product_blood')->__('Blood information')));

        $fieldset->addType('image', 'Product_Blood_Block_Adminhtml_Form_Renderer_Image');
        $fieldset->addField('name', 'text', array(
            'label'    => Mage::helper('product_blood')->__('Name'),
            'name'     => 'name',
            'class'    => 'required-entry',
            'required' => true
        ));

        $fieldset->addField('description', 'text', array(
            'label'    => Mage::helper('product_blood')->__('Description'),
            'name'     => 'description',
            'class'    => 'required-entry',
            'required' => true
        ));

        $fieldset->addField('image_url', 'image', array(
            'label'     => Mage::helper('product_blood')->__('Image'),
            'required'  => false,
            'name'      => 'image_url',
            'directory' => 'blood/'
        ));

        $fieldset->addField('is_active', 'select', array(
            'label'    => Mage::helper('product_blood')->__('Status'),
            'name'     => 'is_active',
            'class'    => 'required-entry',
            'values'   => Mage::getSingleton('adminhtml/system_config_source_enabledisable')->toOptionArray(),
            'required' => true
        ));

        $fieldset->addField('price', 'text', array(
            'label'    => Mage::helper('product_blood')->__('Price'),
            'class'    => 'validate-number',
            'name'     => 'price',
            'required' => true,
            'value'    => 0
        ));

        $fieldset->addField('qty', 'text', array(
            'label'    => Mage::helper('product_blood')->__('Qty'),
            'class'    => 'validate-number',
            'name'     => 'qty',
            'required' => true,
            'value'    => 0
        ));

        if (Mage::getSingleton('adminhtml/session')->getBloodData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBloodData());
            Mage::getSingleton('adminhtml/session')->getBloodData(null);
        } elseif (Mage::registry('blood_data')) {
            $form->setValues(Mage::registry('blood_data')->getData());
        }

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('product_blood')->__('Blood Information');
    }

    public function getTabTitle()
    {
        return Mage::helper('product_blood')->__('Blood Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}