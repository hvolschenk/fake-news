<?php
  namespace Rwdg\Api\Request\Parameter\Headers;
  use Rwdg\Api\Request\Parameter\ParameterFactory;
  trait HeadersTrait {

    private $headers;

    private function setHeaders(Headers $headers) {
      $this->headers = $headers;
    }

    public function getHeaders(): Headers {
      return $this->headers;
    }

    private function buildHeaders() {
      $this->setHeaders(ParameterFactory::makeParameter('Headers'));
    }

  }
