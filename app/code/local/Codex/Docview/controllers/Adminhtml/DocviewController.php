<?php

class Codex_Docview_Adminhtml_DocviewController extends Mage_Adminhtml_Controller_Action
{
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

    public function viewAction()
    {
        $file = $this->getRequest()->getParam('file');
        $module = $this->getRequest()->getParam('module');

        $ext = pathinfo($file, PATHINFO_EXTENSION);

        if( $ext == 'md' ) {
            $this->loadLayout();

            $block = $this->getLayout()->createBlock('codex_docview/adminhtml_parsedown');
            $block->setFile($file);
            $block->setModule($module);

            $this->_addContent( $block );
            $this->renderLayout();
        } else {

            $docFile = Mage::helper('codex_docview')->getDocFile($module,$file);
            readfile($docFile);

        }
    }

}
