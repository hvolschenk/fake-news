<?php
  namespace Rwdg\Api\Request\Parameter\FILES;
  use Rwdg\Api\Request\Parameter\ParameterFactory;
  trait FILESTrait {

    private $files;

    private function setFILES(FILES $files) {
      $this->files = $files;
    }

    public function getFILES(): FILES {
      return $this->files;
    }

    private function buildFILES() {
      $this->setFILES(ParameterFactory::makeParameter('FILES'));
    }

  }
