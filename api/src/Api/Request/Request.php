<?php
  namespace Rwdg\Api\Request;
  class Request extends RequestAbstract {

    use \Rwdg\Api\Request\Parameter\FILES\FILESTrait;
    use \Rwdg\Api\Request\Parameter\GET\GETTrait;
    use \Rwdg\Api\Request\Parameter\Headers\HeadersTrait;
    use \Rwdg\Api\Request\Parameter\POST\POSTTrait;

    public function __construct() {
      $this->buildFILES();
      $this->buildGET();
      $this->buildPOST();
      $this->buildHeaders();
    }

    public function getId(): int {
      return $this->getGET()->getId();
    }

    public function getType(): string {
      return $this->getGET()->getType();
    }

    public function getAction(): string {
      return $this->getGET()->getAction() ?? $this->getHeaders()->getAction() ?? 'Read';
    }

    public function getAuthorization(): string {
      return $_COOKIE['token'] ?? '';
    }

    public function hasId(): bool {
      return $this->getId() > 0;
    }

  }
