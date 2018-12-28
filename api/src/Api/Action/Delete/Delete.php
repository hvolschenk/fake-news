<?php
  namespace Rwdg\Api\Action\Delete;
  class Delete extends \Rwdg\Api\Action\ActionAbstract {

    public function execute() {
      $this->prepare();
      $this->delete();
      $this->output();
    }

    private function prepare() {
      $this->getModel()->setId($this->getRequest()->getId());
    }

    private function delete() {
      $this->getModel()->delete();
    }

    private function output() {
      $this->getResponse()->getOutput()->outputArray([]);
    }

  }
