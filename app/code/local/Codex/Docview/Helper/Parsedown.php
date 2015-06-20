<?php

class Codex_Docview_Helper_Parsedown extends Codex_Docview_Lib_Parsedown
{
    protected $moduleName;
    protected $file;

    protected function inlineLink($Excerpt)
    {
        $res = parent::inlineLink($Excerpt);

        $href = $res['element']['attributes']['href'];

        if (substr($href, 0, strlen('magento:')) == 'magento:') {
            $href = Mage::getUrl(substr($href, strlen('magento:')));
        } elseif (substr($href, 0, 4) != 'http') {
            $href = Mage::getUrl('*/*/view') . '?' . http_build_query(array('file' => $href, 'module' => $this->moduleName));
        }

        $res['element']['attributes']['href'] = $href;

        return $res;
    }


    public function render($moduleName, $file)
    {
        $this->moduleName = $moduleName;
        $this->file = $file;

        $acl = Mage::getConfig()->getNode('admin/docview/' . $moduleName . '/acl');
        if ($acl && !$this->isSomeAllowed($acl)) {
            return null;
        }

        $docFile = Mage::helper('codex_docview')->getDocFile($moduleName, $file);

        return '<div class="markdown">' . $this->parse(file_get_contents($docFile)) . '</div>';
    }

    protected function isSomeAllowed($aclList)
    {
        foreach ($aclList AS $acl1 => $tmp) {
            foreach ($tmp AS $acl2) {
                if (Mage::getSingleton('admin/session')->isAllowed($acl1. '/' . $acl2) )
                {
                    return true;
                }
            }
        }
        return false;
    }

}