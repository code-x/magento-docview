<?php

class Codex_Docview_Adminhtml_DocviewController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        if ($this->getRequest()->getActionName() == 'dev') {
            return Mage::getSingleton('admin/session')->isAllowed('admin/codex_base/codex_docview_dev');
        } else {
            return Mage::getSingleton('admin/session')->isAllowed('admin/codex_base/codex_docview');
        }
    }

    protected function _validateFormKey()
    {
        return true;
    }

    protected function _validateSecretKey()
    {
       return true;
    }

    public function indexAction()
    {
        $docHelper = Mage::helper('codex_docview');
        $docs = $docHelper->getModuleDocs();

        $this->loadLayout();

        foreach( $docs AS $doc ) {
            $block = $this->getLayout()->createBlock('codex_docview/adminhtml_parsedown');
            $block->setFile($doc['file']);
            $block->setModule($doc['module']);
            $this->_addContent( $block );
        }

        $this->renderLayout();
    }

    public function devAction()
    {
        $docHelper = Mage::helper('codex_docview');
        $docs = $docHelper->getModuleDocs('dev');

        $this->loadLayout();

        foreach( $docs AS $doc ) {
            $block = $this->getLayout()->createBlock('codex_docview/adminhtml_parsedown');
            $block->setFile($doc['file']);
            $block->setModule($doc['module']);
            $block->setSubdir($doc['subdir']);
            $this->_addContent( $block );
        }

        $this->renderLayout();
    }

    public function viewAction()
    {
        $file = $this->getRequest()->getParam('file');
        $module = $this->getRequest()->getParam('module');
        $subdir = $this->getRequest()->getParam('subdir');

        $ext = pathinfo($file, PATHINFO_EXTENSION);

        if( $ext == 'md' ) {
            $this->loadLayout();

            $block = $this->getLayout()->createBlock('codex_docview/adminhtml_parsedown');
            $block->setFile($file);
            $block->setModule($module);
            $block->setSubdir($subdir);

            $this->_addContent( $block );
            $this->renderLayout();
        } else {

            $docFile = Mage::helper('codex_docview')->getDocFile($module,$file, $subdir);
            readfile($docFile);

        }
    }

}
