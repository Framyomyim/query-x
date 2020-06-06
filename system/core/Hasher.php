<?php 

    namespace QueryX\Support;

    class Hasher {
        private $string = null;
        public $encrypts = [];
        public $decrypts = [];

        public function set(string $str) {
            $this->string = $str;
            return $this;
        }

        public function encrypt() {
            $number = $this->alphaToInt($this->string);
            $alphabet = $this->string;
            $spl_number = str_split($number);
            $spl_alpha = str_split($alphabet);
            $modify = '';
            foreach($spl_number as $key => $number) {
                if($key > (count($spl_alpha) - 1)) {
                    $modify .= $number;
                    continue;
                }
                $modify .= base64_encode($spl_alpha[$key]) . $number;
            }
            array_push($this->encrypts, $modify);
            return base64_encode($modify);
        }

        public function decrypt() {
            $sp1 = base64_decode($this->string);
            $modify = '';
            $sp2 = str_split($sp1, 5);
            foreach($sp2 as $codex) {
                $enc = substr($codex, 0, 4);
                $enc = base64_decode($enc);
                if(strlen($enc) == 1) {
                    $modify .= $enc;
                    continue;
                }
            }
            
            return $modify;
        }
        
        protected function alphaToInt(string $str) {
            $alphabet = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
            $alpha_flip = array_flip($alphabet);
            if(strlen($str) == 1) return (isset($alpha_flip[$str]) ? $alpha_flip[$str] : FALSE);
            else if(strlen($str) > 1) {
                $num = 1;
                for($i = 0; $i < strlen($str); $i++){
                    if(($i + 1) < strlen($str)) $num *= (26 * ($alpha_flip[$str[$i]] + 1));
                    else $num += ($alpha_flip[$str[$i]] + 1);
                }
            }
            return ($num + 25);
        }
    }

?>