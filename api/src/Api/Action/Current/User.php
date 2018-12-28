<?php
  namespace Rwdg\Api\Action\Current;
  class User extends \Rwdg\Api\Action\ActionAbstract {

    use \Rwdg\Api\Query\QueryString\QueryStringTrait;

    public function execute() {
      $this->prepare();
      $this->fetch();
      $this->output();
    }

    private function prepare() {
      $this->buildQueryString($this->getRequest()->getGET()->getValue());
    }

    private function fetch() {
      $this->getUser()->fetchLinks($this->getQueryString());
    }

    private function output() {
      $this->getResponse()->getOutput()->outputModel($this->getUser());
    }

  }
