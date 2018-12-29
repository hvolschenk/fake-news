<?php
  namespace Rwdg\Api\Request\Parameter\FILES;
  class FILES extends \Rwdg\Api\Request\Parameter\ParameterAbstract {

    protected function buildValue() {
      $this->setValue($_FILES ?? []);
    }

  }
