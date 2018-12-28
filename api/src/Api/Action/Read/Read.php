<?php
  namespace Rwdg\Api\Action\Read;
  use Rwdg\Api\Query\QueryFactory;
  use Rwdg\Api\Query\QueryInterface;
  use Rwdg\Api\Query\QueryString\QueryStringFactory;
  use Rwdg\Api\Query\QueryString\QueryStringInterface;
  use Rwdg\Config\Connection as Config;
  class Read extends \Rwdg\Api\Action\ActionAbstract {

    use \Rwdg\Api\Query\QueryTrait;
    use \Rwdg\Api\Query\QueryString\QueryStringTrait;

    public function execute() {
      $this->prepare();
      $this->read();
      $this->output();
    }

    private function prepare() {
      $model = $this->getModel();
      $model->setId($this->getRequest()->getId());
      $request = $this->getRequest();
      $this->buildQueryString($request->getGET()->getValue());
      $this->buildQuery($request->getType(), Config::DRIVER, $this->getQueryString(), $model);
    }

    private function read() {
      if ($this->getRequest()->hasId()) {
        $this->readModel();
      } else {
        $this->readCollection();
      }
    }

    private function readModel() {
      $model = $this->getModel();
      $model->fetch($this->getQuery());
      $model->fetchLinks($this->getQueryString());
    }

    private function readCollection() {
      $this->getCollection()->fetch($this->getQuery(), true);
    }

    private function output() {
      if ($this->getRequest()->hasId()) {
        $this->getResponse()->getOutput()->outputModel($this->getModel());
      } else {
        $this->getResponse()->getOutput()->outputCollection($this->getCollection());
      }
    }

  }
