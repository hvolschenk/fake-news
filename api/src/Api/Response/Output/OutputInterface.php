<?php
  namespace Rwdg\Api\Response\Output;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\ModelInterface;
  interface OutputInterface {

    public function outputCollection(CollectionInterface $collection);

    public function outputModel(ModelInterface $model);

    public function outputArray(array $array);

  }
