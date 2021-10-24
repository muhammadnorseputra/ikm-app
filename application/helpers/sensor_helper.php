<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      
    if ( ! function_exists('sensor'))
    {
        function sensor($str) {
            $target = $str;
            $count = strlen($target) - 3;
            $asterix = '';

            for ($a = 0; $a <= $count; $a++) {
                $asterix .= '*';
            }

            $output = substr($target, 0, 4) . $asterix . substr($target, -3);

            return $output;
        }
    }

?>