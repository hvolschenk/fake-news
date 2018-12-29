<?php
  namespace Rwdg\Api\Response\Output\JSON;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\ModelInterface;
  class JSON extends \Rwdg\Api\Response\Output\OutputAbstract {

    const CONTENT_TYPE = 'application/json';

    public function outputCollection(CollectionInterface $collection) {
      echo self::collectionAsJSON($collection);
    }

    public function outputModel(ModelInterface $model) {
      $this->addModelError($model);
      echo self::modelAsJSON($model);
    }

    private function addModelError(ModelInterface $model) {
      if ($model->hasErrors()) {
        $this->setResponseCode(400);
      }
    }

    private static function collectionAsJSON(CollectionInterface $collection): string {
      return json_encode($collection->asArray());
    }

    private static function modelAsJSON(ModelInterface $model): string {
      return json_encode($model->asArray());
    }

  }
