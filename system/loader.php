<?php

    namespace QueryX\Support;

    use Medoo\Medoo;
    use Jenssegers\Blade\Blade;

    class Loader {

        private $_typeGet = null;
        function __construct($type = null) {
            $this->_typeGet = $type;
        }

        public static function view(string $viewName, array $params = []) {
            $blade = self::get_blade();
            return $blade->make($viewName, $params)->render();
        }

        private static function get_blade() {
            $blade = new Blade(QUERYX_PUBLIC . 'views/', QUERYX_HOME . 'app/cache/view/');
            return $blade;
        }

        public static function controller(string $path, array $params = []) {
            $splits = explode('@', $path);
            $subpath = explode('.', $splits[0]);
            $controller = end($subpath);
            $method = $splits[1];
            if(is_file(QUERYX_CONTROLLER . join('/', $subpath) . '.php')) {
                include QUERYX_CONTROLLER . join('/', $subpath) . '.php';
                if(class_exists($controller)) {
                    $request = defined('QUERYX') ? QUERYX : 'error';
                    $dispatcher = new $controller($request);
                    call_user_func_array([$dispatcher, $method], $params);
                }
            } else {
                return false;
            }
        }

        public static function model(string $path) {
            $splits = explode('.', $path);
            $model = end($splits);
            if(is_file(QUERYX_MODEL . join('/', $splits) . '.php')) {
                include QUERYX_MODEL . join('/', $splits) . '.php';
                if(class_exists($model)) return new $model();
                else return null;
            } else {
                return null;
            }
        }

        private static $_helper, $_core;
        public static function helper($name) { 
            self::$_helper = $name; 
            return new Loader('helper');
        }

        public static function core($name) {
            self::$_core = $name;
            return new Loader('core');
        }

        public function get(bool $custom = false) {
            // $custom false == get in system
            // $custom true == get in app
            $custom = ($custom == false) ? 'system' : 'app';
            if($this->_typeGet == 'helper') {
                // load helper
                $path = str_replace('.', '/', self::$_helper) . '.php';
                if(is_file(QUERYX_HOME . $custom . '/helper/' . $path)) include_once QUERYX_HOME . $custom . '/helper/' . $path;
                else return;
            } else if($this->_typeGet == 'core') {
                // load core
                $path = str_replace('.', '/', self::$_core) . '.php';
                $dispatcher = explode('.', self::$_core);
                $dispatcher = end($dispatcher);
                
                # debug
                # echo QUERYX_HOME . $custom . '/core/' . $path;

                if(is_file(QUERYX_HOME . $custom . '/core/' . $path)) {
                    include_once QUERYX_HOME . $custom . '/core/' . $path;
                    if(class_exists($dispatcher)) return new $dispatcher();
                    else return;
                } else return;
            }
        }

        private static $_config_database = [];

        public static function database() {
            self::$_config_database = QUERYX_DATABASE;
            return new Loader();
        }

        public function getInstance() {
            return new Medoo(self::$_config_database);
        }

    }

?>