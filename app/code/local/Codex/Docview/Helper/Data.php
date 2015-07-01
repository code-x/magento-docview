<?php

class Codex_Docview_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getModuleDocs( $subdir = false )
    {
        $docs = array();
        $modules = (array)Mage::getConfig()->getNode('modules')->children();

        foreach ($modules as $moduleName => $config) {
            $docDir = dirname(Mage::getModuleDir('etc', $moduleName)).DS.'doc';
            if( $subdir ) {
                $docDir .= DS.$subdir;
            }
            $docFile = 'index.md';

            if( file_exists($docDir.DS.$docFile) )
            {
                $docs[] = array('module' => $moduleName, 'file' => $docFile, 'subdir' => $subdir);
            }

        }
        return $docs;
    }

    public function getDocFile($moduleName, $file, $subDir=false)
    {
        $moduleDir = realpath( dirname(Mage::getModuleDir('etc', $moduleName)) );

        if( $subDir )
        {
            $docFile = realpath($moduleDir . DS . 'doc'.DS.$subDir.DS.$file);
        } else {
            $docFile = realpath($moduleDir . DS . 'doc'.DS.$file);
        }

        if( is_file($docFile) && substr($docFile,0, strlen($moduleDir)) == $moduleDir ) {
            return $docFile;
        }

        return null;
    }


}