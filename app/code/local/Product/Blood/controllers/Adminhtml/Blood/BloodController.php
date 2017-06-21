<?php

class Product_Blood_Adminhtml_Blood_BloodController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        return $this->loadLayout()->_setActiveMenu('product_blood');
    }

    /**
     * @return Mage_Core_Controller_Varien_Action
     */
    public function indexAction()
    {
        return $this->_initAction()->renderLayout();
    }

    /**
     * @return $this
     */
    public function newAction()
    {
        $this->_forward('edit');

        return $this;
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Product_Blood_Model_Blood $blood */
        $blood = Mage::getModel('product_blood/blood')->load($id);

        if ($blood->getId() || $id == 0) {

            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $blood->setData($data);
            }
            Mage::register('blood_data', $blood);

            return $this->_initAction()->renderLayout();
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product_blood')->__('Blood does not exist'));

        return $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $delete = (!isset($data['image_url']['delete']) || $data['image_url']['delete'] != '1') ? false : true;
            $data['image_url'] = $this->_saveImage('image_url', $delete);

            /** @var Product_Blood_Model_Blood $blood */
            $blood = Mage::getModel('product_blood/blood');

            if ($id = $this->getRequest()->getParam('id')) {
                $blood->load($id);
            }

            try {
                $blood->addData($data);
                $blood->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product_blood')->__('The blood has been saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array(
                        'id'       => $blood->getId(),
                        '_current' => true
                    ));

                    return;
                }

                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_getSession()->addException($e, Mage::helper('product_blood')->__('An error occurred while saving the blood.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array(
                'id' => $this->getRequest()->getParam('id')
            ));

            return;
        }
        $this->_redirect('*/*/');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                /** @var Product_Blood_Model_Blood $blood */
                $blood = Mage::getModel('product_blood/blood');
                $blood->load($id)->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product_blood')->__('Blood was successfully deleted'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }

        return $this->_redirect('*/*/');
    }

    /**
     *  Save image into magento files
     */
    protected function _saveImage($imageAttr, $delete)
    {
        if ($delete) {
            $image = '';
        } elseif (isset($_FILES[$imageAttr]['name']) && $_FILES[$imageAttr]['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader($imageAttr);
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media') . DS . 'blood' . DS;
                $uploader->save($path, $_FILES[$imageAttr]['name']);
                $image = $_FILES[$imageAttr]['name'];
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                return $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        } else {
            $model = Mage::getModel('product_blood/blood')->load($this->getRequest()->getParam('id'));
            $image = $model->getData($imageAttr);
        }
        return $image;
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function massDeleteAction()
    {
        $bloodIds = $this->getRequest()->getParam('blood');
        if (!is_array($bloodIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product_blood')->__('Please select blood(s)'));
        } else {
            try {
                foreach ($bloodIds as $blood) {
                    Mage::getModel('product_blood/blood')->load($blood)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product_blood')->__('Total of %d blood(s) were successfully deleted', count($bloodIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        return $this->_redirect('*/*/index');
    }

    /**
     * @return $this|Mage_Core_Controller_Varien_Action
     */
    public function massStatusAction()
    {
        $bloodIds = $this->getRequest()->getParam('blood');
        if (!is_array($bloodIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select blood(s)'));
        } else {
            try {
                foreach ($bloodIds as $blood) {
                    Mage::getSingleton('product_blood/blood')->load($blood)->setIsActive($this->getRequest()->getParam('is_active'))->setIsMassupdate(true)->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('product_blood')->__('Total of %d blood(s) were successfully updated', count($bloodIds)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        return $this->_redirect('*/*/index');
    }
}