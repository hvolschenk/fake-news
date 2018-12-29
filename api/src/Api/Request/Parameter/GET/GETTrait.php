<?php
  namespace Rwdg\Api\Request\Parameter\GET;
  use Rwdg\Api\Request\Parameter\ParameterFactory;
  trait GETTrait {

    private $get;

    private function setGET(GET $get) {
      $this->get = $get;
    }

    public function getGET(): GET {
      return $this->get;
    }

    private function buildGET() {
      $this->setGET(ParameterFactory::makeParameter('GET'));
    }

  }
