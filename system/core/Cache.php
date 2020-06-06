<?php 

    namespace QueryX\Support;

    class Cache {
        public $cacheTime = '';
        public $cacheFolder = QUERYX_HOME . 'app/cache/default/';
        public $cacheExtension = '.cache';
        public $cacheFile = '';

        public $cacheAutosave = false;

        private $cacheLists = [];

        /**
         * @param int $cacheTime Unit is minute
         */
        function __construct($cacheTime = 10) {
            $this->cacheTime = $cacheTime;

            if(is_dir($this->cacheFolder)) {
                if($dirHandler = opendir($this->cacheFolder)) {
                    while(($file = readdir($dirHandler)) !== false) {
                        if($file == '.' || $file == '..') continue;
                        array_push($this->cacheLists, $file);
                    }
                    closedir($dirHandler);
                }
            }
        }

        public function isCache(string $key) {
            $nameOfCache = md5($key) . $this->cacheExtension;
            if(in_array($nameOfCache, $this->cacheLists) && !empty((file_get_contents($this->cacheFolder . $nameOfCache)))) return true;
            else false;
        }

        public function getCache(string $key) {
            $nameOfCache = md5($key) . $this->cacheExtension;
            if($this->isCache($key)) {
                if($this->cacheAutosave == true && (time() - filemtime($this->cacheFolder . $nameOfCache)) > $this->cacheTime) return false;
                else return file_get_contents($this->cacheFolder . $nameOfCache);
            }
            else return false;
        }

        public function saveCache(string $key, $data = null) {
            $nameOfCache = $this->cacheFolder . md5($key) . $this->cacheExtension;
            $cacheContent = sha1(file_get_contents($nameOfCache));
            $newContent = sha1($data);

            if($this->cacheAutosave == true) {
                if(file_exists($nameOfCache) && ((time() - filemtime($nameOfCache)) > $this->cacheTime) || $cacheContent != $newContent) {
                    file_put_contents($nameOfCache, $data);
                }
            } else {
                file_put_contents($nameOfCache, $data);
            }
        }
    }

?>