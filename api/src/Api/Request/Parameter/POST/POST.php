<?php
  namespace Rwdg\Api\Request\Parameter\POST;
  class POST extends \Rwdg\Api\Request\Parameter\ParameterAbstract {

    protected function buildValue() {
      $post = [];
      $pairs = explode('&', file_get_contents('php://input'));
      foreach ($pairs as $pair) {
        $parameter = explode('=', $pair);
        $post[$parameter[0]] = isset($parameter[1]) ? urldecode($parameter[1]) : null;
      }
      $this->setValue($post);
    }

  }
