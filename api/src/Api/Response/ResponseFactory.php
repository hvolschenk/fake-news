<?php
  namespace Rwdg\Api\Response;
  use Rwdg\Api\Response\Output\OutputInterface;
  class ResponseFactory {

    public static function makeResponse(OutputInterface $output): ResponseInterface {
      return self::getClass($output);
    }

    private static function getClass(OutputInterface $output): ResponseInterface {
      return new Response($output);
    }

  }
