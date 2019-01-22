<?php
  namespace Rwdg\Api\Action\Restart;
  class User extends \Rwdg\Api\Action\ActionAbstract {

    use \Rwdg\Api\Query\QueryString\QueryStringTrait;

    public function execute() {
      $this->createNewSession();
      $this->removeSessionVariables();
      $this->removeSession();
      $this->getNewUser();
      $this->fetch();
      $this->output();
    }

    private function createNewSession() {
      session_regenerate_id();
    }

    private function fetch() {
      $this->buildQueryString($this->getRequest()->getGET()->getValue());
      $this->getUser()->fetchLinks($this->getQueryString());
    }


    private function getNewUser() {
      $this->getUser()->fetchFromSessionId(session_id());
    }

    private function output() {
      $this->getResponse()->getOutput()->outputModel($this->getUser());
    }

    private function removeSession() {
      session_destroy();
      session_start();
    }

    private function removeSessionVariables() {
      session_unset();
    }

  }
