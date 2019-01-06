<?php
  namespace Rwdg\Api\Action\Create;
  class Action extends Create {

    public function execute() {
      parent::execute();
      $this->addLinks();
    }

    private function addLinks() {
      $model = $this->getModel();
      $this->getUser()->addLink($model->get('id'));
      $model->addLink($this->getRequest()->getPOST()->getValue()['questionId']);
    }

  }
