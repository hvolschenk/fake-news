<?php
  namespace Rwdg\Api\Action\Create;
  use Rwdg\Config\Connection as Config;
  use Rwdg\Api\Model\ModelFactory;
  class Create extends \Rwdg\Api\Action\ActionAbstract {

    use \Rwdg\Api\Query\QueryTrait;
    use \Rwdg\Api\Query\QueryString\QueryStringTrait;

    public function execute() {
      $this->prepare();
      if (!$this->getModel()->hasErrors()) {
        $this->create();
        $this->read();
        $this->hookExecutePost();
      }
      $this->output();
    }

    private function prepare() {
      $this->setModelValuesFromPOST();
      $this->validateModel();
    }

    private function setModelValuesFromPOST() {
      $this->getModel()->setValuesFromArray($this->getRequest()->getPOST()->getValue());
    }

    protected function validateModel() {
      $model = $this->getModel();
      $model->validate($model->getSchema()->getFieldsCreate());
    }

    private function create() {
      $this->getModel()->create($this->getModel()->createId($this->getUser()->get('id')));
    }

    private function read() {
      $model = $this->getModel();
      $request = $this->getRequest();
      $this->buildQueryString($request->getGET()->getValue() ?? []);
      $this->buildQuery($request->getType(), Config::DRIVER, $this->getQueryString(), $model);
      $model->fetch($this->getQuery());
    }

    private function output() {
      $this->getResponse()->getOutput()->outputModel($this->getModel());
    }

  }
