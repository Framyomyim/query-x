<?php 

    namespace QueryX\Support;

    if(!class_exists('Logger')) {
        class Logger {
            private $path = QUERYX_HOME . 'app/log/';
            private $extension = '.log';
            // [18:08 PM YOUR_IP] : Change account name..
            private $formatLog = '[%1 %2] : %3';

            public function setFormatter($formatter) {
                $this->formatLog = $formatter;
            }

            public function setExtension(string $extension) {
                $this->extension = $extension;
            }

            public function setPath($path) {
                $this->path = $path;
            }

            public function saveLog(string $file, array $dataFormatter = ['%1' => 'time', '%2' => 'ip', '%3' => 'message']) {
                $toWrite = strtr($this->formatLog, $dataFormatter);
                $fullPath = $this->path . md5($file) . $this->extension;
                $result = $this->append($fullPath, $toWrite);
                return $result;
            }

            private function append($fullPath, $toWrite) {
                $handler = fopen($fullPath, 'a');
                if(!$handler) return false;
                $toWrite = $toWrite . "\n";
                fwrite($handler, $toWrite);
                fclose($handler);
                return true;
            }

            public function clearLog(string $file, bool $del = false) {
                $fullPath = $this->path . md5($file) . $this->extension;
                if($del) unlink($fullPath);
                else file_put_contents($fullPath, '');
                return true;
            }

            public function getLog(string $file) {
                $fullPath = $this->path . md5($file) . $this->extension;
                if(is_file($fullPath)) {
                    $data = explode("\n", file_get_contents($fullPath));
                    $output = [];
                    foreach($data as $key => $check) {
                        if(empty(trim($check))) continue;
                        $output[$key] = $check;
                    }
                    return $output;
                } else return false;
            }

            public function clearAll(bool $del = false) {
                $files = glob($this->path . '*'); 
                foreach($files as $file) {
                    if(is_file($file)) $this->clearLog($file, $del);
                }
            }
        }
    }

?>