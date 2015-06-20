<?php

class Codex_Docview_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getModuleDocs()
    {
        $docs = array();
        $modules = (array)Mage::getConfig()->getNode('modules')->children();

        foreach ($modules as $moduleName => $config) {
            $docDir = dirname(Mage::getModuleDir('etc', $moduleName)).DS.'doc';
            $docFile = 'index.md';

            if( file_exists($docDir.DS.$docFile) )
            {
                $docs[] = array('module' => $moduleName, 'file' => $docFile);
            }

        }
        return $docs;
    }

    public function getDocFile($moduleName, $file)
    {
        $moduleDir = realpath( dirname(Mage::getModuleDir('etc', $moduleName)) );
        $docFile = realpath($moduleDir . DS . 'doc'.DS.$file);

        if( is_file($docFile) && substr($docFile,0, strlen($moduleDir)) == $moduleDir ) {
            return $docFile;
        }

        return null;
    }


}