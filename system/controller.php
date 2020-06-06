<?php 

    namespace QueryX\Common;

    use QueryX\Support\Loader;
    use QueryX\Interfaces;

    class Controller implements Interfaces\ControllerInterface {
        protected $_cert = false;
        function __construct($request) {
            $this->generate($request);
        }

        private $verifyApp = 'application';
        private function generate($request) {
            if($request == $this->verifyApp) $this->_cert = true;
            $this->render();
        }

        private function render() {
            if($this->_cert == false) die(Loader::view('errors.verify'));
        }
    }

?>