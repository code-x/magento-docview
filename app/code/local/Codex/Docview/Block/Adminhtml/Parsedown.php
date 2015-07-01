<?php

class Codex_Docview_Block_Adminhtml_Parsedown extends Mage_Core_Block_Template
{

    protected $_file;
    protected $_module;
    protected $_subdir;

    public function setFile($file)
    {
        $this->_file = $file;
        return $this;
    }

    public function setModule($module)
    {
        $this->_module = $module;
    }

    public function setSubdir($subdir)
    {
        $this->_subdir = $subdir;
    }

    protected function _toHtml()
    {
        $docHelper = Mage::helper('codex_docview/parsedown');
        return $docHelper->render( $this->_module, $this->_file, $this->_subdir  );
    }

}