<?php 

    if(!function_exists('base_url')) {
        function base_url($path = null) {
            $url = QUERYX_BASE_URL;
            if(substr($url, -1) != '/') $url .= '/';
            return $url . $path;
        }
    }

    if(!function_exists('asset')) {
        function asset($path = null) {
            return base_url('public/assets/' . $path);
        }
    }

?>