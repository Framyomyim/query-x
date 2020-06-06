<?php

    # Get All Important Files
    $impfiles = [
        QUERYX_CONFIG . 'database.php',
        QUERYX_CONFIG . 'config.php',
        QUERYX_SYSTEM . 'autoload.php',
        QUERYX_SYSTEM . 'interface/Icontroller.php',
        QUERYX_SYSTEM . 'interface/Imodel.php',
        QUERYX_SYSTEM . 'controller.php',
        QUERYX_SYSTEM . 'model.php',
        QUERYX_VENDOR . 'autoload.php',
        QUERYX_SYSTEM . 'loader.php',
        QUERYX_SYSTEM . 'helper/component.php',
        QUERYX_CONFIG . 'routes.php',
    ];

    foreach($impfiles as $file) {
        if(is_file($file)) require_once $file;
    }

?>