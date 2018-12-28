<?php
  namespace Rwdg\Api\Action\Update;
  use Rwdg\Config\Connection as Config;
  use Rwdg\Api\Model\ModelFactory;
  class Update extends \Rwdg\Api\Action\ActionAbstract {

    use \Rwdg\Api\Query\QueryTrait;
    use \Rwdg\Api\Query\QueryString\QueryStringTrait;

    public function execute() {
      $this->prepare();
      if (!$this->getModel()->hasErrors()) {
        $this->update();
        $this->read();
      }
      $this->output();
    }

    private function prepare() {
      $this->setModelValues();
      $this->validateModel();
    }

    private function setModelValues() {
      $model = $this->getModel();
      $request = $this->getRequest();
      $model->setId($request->getGET()->getValue()['id']);
      $this->read();
      $model->setValuesFromArray($request->getPOST()->getValue());
    }

    protected function validateModel() {
      $model = $this->getModel();
      $model->validate($model->getSchema()->getFieldsUpdate());
    }

    protected function update() {
      $this->getModel()->update();
    }

    private function read() {
      $model = $this->getModel();
      $request = $this->getRequest();
      $this->buildQueryString($request->getGET()->getValue());
      $this->buildQuery($request->getType(), Config::DRIVER, $this->getQueryString(), $model);
      $model->fetch($this->getQuery());
      $model->fetchLinks($this->getQueryString());
    }

    private function output() {
      $this->getResponse()->getOutput()->outputModel($this->getModel());
    }

  }
