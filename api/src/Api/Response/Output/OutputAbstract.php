<?php
  namespace Rwdg\Api\Response\Output;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\ModelInterface;
  abstract class OutputAbstract implements OutputInterface {

    const CONTENT_TYPE = 'text/html';

    public function __construct() {
      $this->setContentType();
    }

    public function setResponseCode(int $responseCode) {
      http_response_code($responseCode);
    }

    abstract public function outputCollection(CollectionInterface $collection);

    abstract public function outputModel(ModelInterface $model);

    public function outputArray(array $array) {
      echo json_encode($array);
    }

    private function setContentType() {
      header('Content-Type: ' . get_called_class()::CONTENT_TYPE);
    }

  }
