<?php
  namespace Rwdg\Api\Request;
  trait RequestTrait {

    private $request;

    protected function setRequest(RequestInterface $request) {
      $this->request = $request;
    }

    protected function getRequest(): RequestInterface {
      return $this->request;
    }

  }
