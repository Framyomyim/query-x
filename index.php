<?php
    /**
     * QueryX (QX) Web Component Using PHP
     * For Peoples Who loved PHP
     * Easy And Fastest
     * Best Quality
     * Free - Open Source
     * Email kittichai.malain@gmail.com
     * --version 1
     * --copyright MIT
     * --author Kittichai Mala-in
    */
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    /**
     * @var define::QUERYX_HOME
     * @param string Path, Path Local Storage
     */
    define('QUERYX_HOME', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__) . DIRECTORY_SEPARATOR));

    /**
     * @var define::QUERYX_CONFIG
     * @param string Path, Path Config Folder
     */
    define('QUERYX_CONFIG', QUERYX_HOME . 'config/');

    /**
     * @var define::QUERYX_PUBLIC
     * @param string Path, Path Public Folder
     */
    define('QUERYX_PUBLIC', QUERYX_HOME . 'public/');

    /**
     * @var define::QUERYX_SYSTEM
     * @param string Path, Path System Folder
     */
    define('QUERYX_SYSTEM', QUERYX_HOME . 'system/');

    /**
     * @var define::QUERYX_VENDOR
     * @param string Path, Path Vendor Folder
     */
    define('QUERYX_VENDOR', QUERYX_HOME . 'vendor/');

    /**
     * @var define::QUERYX_COMPONENT
     * @param string Path, Path Component Folder
     */
    define('QUERYX_COMPONENT', QUERYX_PUBLIC . 'components/');

    /**
     * @var define::QUERYX_CONTROLLER
     * @param string Path, Path Controller Folder
     */
    define('QUERYX_CONTROLLER', QUERYX_HOME . 'app/controller/');

    /**
     * @var define::QUERYX_MODEL
     * @param string Path, Path Model Folder
     */
    define('QUERYX_MODEL', QUERYX_HOME . 'app/model/');

    /**
     * @var define::QUERYX
     * @param string Request, Important for Controller
     */
    define('QUERYX', 'application');

    # Start Application
    require_once QUERYX_SYSTEM . 'bootstrap.php';

?>