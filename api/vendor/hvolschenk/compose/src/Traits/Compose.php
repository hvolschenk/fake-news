<?php
  namespace Hvolschenk\Traits;
  trait Compose {

    private static function compose($value, array $functions) {
      return array_reduce($functions, function($result, $function) {
        return call_user_func(['self', $function], $result);
      }, $value);
    }

    private function composeNonStatic($value, array $functions) {
      return array_reduce($functions, function($result, $function) {
        return call_user_func([$this, $function], $result);
      }, $value);
    }

    private function composeMixed($value, array $functions) {
      return array_reduce($functions, function($result, $function) {
        return call_user_func($function, $result);
      }, $value);
    }

  }
