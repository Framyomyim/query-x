<?php 

    /**
     * Load Helper
     */
    foreach(QUERYX_AUTOLOAD as $ch => $val) {
        foreach($val as $type => $loader) {
            $folderName = QUERYX_HOME;
            $folderName .= $type . '/';
            $folderName .= $ch === 'helpers' ? 'helper/' : 'core/';
            foreach($loader as $load) {
                $f = str_replace('.', '/', $load) . '.php';
                $filename = $folderName . $f;
                if(is_file($filename)) require_once $filename;
            }
        }
    }

?>