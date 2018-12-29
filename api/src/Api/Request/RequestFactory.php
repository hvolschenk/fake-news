<?php
  namespace Rwdg\Api\Request;
  class RequestFactory {

    public static function makeRequest(): RequestInterface {
      return self::getClass();
    }

    private static function getClass(): RequestInterface {
      return new Request();
    }

  }
