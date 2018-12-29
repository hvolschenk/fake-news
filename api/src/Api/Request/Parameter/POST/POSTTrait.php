<?php
  namespace Rwdg\Api\Request\Parameter\POST;
  use Rwdg\Api\Request\Parameter\ParameterFactory;
  trait POSTTrait {

    private $post;

    private function setPOST(POST $post) {
      $this->post = $post;
    }

    public function getPOST(): POST {
      return $this->post;
    }

    private function buildPOST() {
      $this->setPOST(ParameterFactory::makeParameter('POST'));
    }

  }
