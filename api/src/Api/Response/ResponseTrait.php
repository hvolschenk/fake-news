<?php
  namespace Rwdg\Api\Response;
  trait ResponseTrait {

    private $response;

    private function setResponse(ResponseInterface $response) {
      $this->response = $response;
    }

    protected function getResponse(): ResponseInterface {
      return $this->response;
    }

  }
