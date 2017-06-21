<?php

class Product_Blood_Block_Adminhtml_Blood_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId   = 'id';
        $this->_blockGroup = 'product_blood';
        $this->_controller = 'adminhtml_blood';

        $this->_updateButton('save', 'label', Mage::helper('product_blood')->__('Save Blood'));
        $this->_updateButton('delete', 'label', Mage::helper('product_blood')->__('Delete Blood'));
        $this->_removeButton('reset');

        $this->_addButton('saveandcontinue', array(
            'label'   => Mage::helper('product_blood')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('blood_data') && Mage::registry('blood_data')->getId()) {
            return Mage::helper('product_blood')->__("Edit Blood '%s'", Mage::registry('blood_data')->getName());
        } else {
            return Mage::helper('product_blood')->__('Add Blood');
        }
    }
}