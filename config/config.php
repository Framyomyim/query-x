<?php 

    /**
     * @var define::QUERYX_BASE_URL
     * @param Url, Your base url
     */
    define('QUERYX_BASE_URL', 'http://localhost:85/');

    /**
     * @var define::QUERYX_AUTOLOAD
     * @param Autoload, Set your autoload files
     */
    // Example 
    // Ex1 : 'filename'
    // Ex2 : 'folder.folder.filename'
    // Don't add .php
    define('QUERYX_AUTOLOAD', [
        // Helper
        'helpers'   =>  [
            // In app/helper/
            'app'   =>  [
                
            ],
            // In system/helper/
            'system' => [
                'url'
            ]
        ],
        // Core
        'cores'     =>  [
            // In app/core/
            'app'   => [

            ],
            // In system/core/
            'system' => [

            ]
        ]
    ]);

?>