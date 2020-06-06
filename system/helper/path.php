<?php 

    if(!function_exists('get_path')) {
        function get_path($path = null) {
            return QUERYX_HOME . $path;
        }
    }

?>