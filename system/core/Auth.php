<?php 
    /**
     * 
     * Beta Core Auth 1.0
     * Development by Kittichai Mala-in
     * 
     */

    namespace QueryX\Common;

    use QueryX\Support\Loader;

    if(!class_exists('Auth')) {
        class Auth {

            public $cookie_name = 'auth_generate_login';
            public $cookie_expire = 3600;

            protected $db = null;
            function __construct($db) {
                $this->db = $db;
            }

            public $_user_data = [];
            public $_user_table = '';
            /**
             * @example 
             * @param string $table = 'users'
             * @param array $users = [
             *      'field_name'    =>  [
             *          'value'     =>  'input_from_user',
             *          'minlength' =>  5,
             *          'maxlength' =>  15
             *      ]
             * ]
             */
            public function set_user_data(string $table, array $users) {
                $this->_user_table = $table;
                $this->_user_data = $users;
                return $this;
            }

            private function generate_cookie($first_field) {
                setcookie($this->cookie_name, $first_field, time() + $this->cookie_expire);
                return;
            }

            public function logout() {
                setcookie($this->cookie_name, null, time() - $this->cookie_expire);
                return true;
            }

            private $invalid = false;
            public function prepare() {
                $dataToLogin = [];
                foreach($this->_user_data as $field => $infos) {
                    if(!array_key_exists('value', $infos)) {
                        $this->invalid = true;
                        continue;
                    }
    
                    $value = $infos['value'];
                    if(array_key_exists('maxlength', $infos)) {
                        $lengthOfValue = strlen($value);
                        if($lengthOfValue > $infos['maxlength']) {
                            $this->invalid = true;
                            continue;
                        }
                    }
    
                    if(array_key_exists('minlength', $infos)) {
                        $lengthOfValue = strlen($value);
                        if($lengthOfValue < $infos['minlength']) {
                            $this->invalid = true;
                            continue;
                        }
                    }
    
                    $dataToLogin[ $field ] = $value;
                }
    
                return $dataToLogin;
            }

            private $prepareData;
            public function login() {
                $dataToLogin = $this->prepare();

                if($this->invalid == false) {
                    $this->prepareData = $dataToLogin;
                    $result = $this->db->get($this->_user_table, '*', $this->prepareData);
                    if($result) {
                        $generate = '';
                        foreach($result as $row) {
                            $generate = $row;
                            break;
                        }
                        $this->generate_cookie($generate);
                        return true;
                    } else false;
                } else false;
            }

            public function register() {
                $dataToRegister = $this->prepare();
                
                if($this->invalid == false) {
                    $this->prepareData = $dataToRegister;
                    $result = $this->db->insert($this->_user_table, $this->prepareData);
                    if($result) return true;
                    else false;
                } else false;
            }

            public function isLogined() {
                if(isset($_COOKIE[ $this->cookie_name ])) return true;
                else false;
            }

            public function getCookie() {
                if($this->isLogined()) return $_COOKIE[ $this->cookie_name ];
                else null;
            }
        }

    }

?>