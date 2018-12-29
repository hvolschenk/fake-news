<?php
  error_reporting(E_ALL);
  $start = microtime(1);

  if(!function_exists('apache_request_headers')) {
    function apache_request_headers() {
      $arh = array();
      $rx_http = '/\AHTTP_/';
      foreach($_SERVER as $key => $val) {
        if(preg_match($rx_http, $key)) {
          $arh_key = preg_replace($rx_http, '', $key);
          $rx_matches = array();
          $rx_matches = explode('_', $arh_key);
          if(count($rx_matches) > 0 and strlen($arh_key) > 2) {
            foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
            $arh_key = implode('-', $rx_matches);
          }
          $arh[$arh_key] = $val;
        }
      }
      return( $arh );
    }
  }

  require('../../vendor/autoload.php');
  require('Bootstrap/index.php');
  $end = microtime(1);
  $time = $end - $start;
  // echo "\n\nPage took " . (round($time, 5) * 1000) . 'ms to build.';
