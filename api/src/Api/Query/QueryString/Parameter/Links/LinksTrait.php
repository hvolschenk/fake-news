<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Links;
  use Rwdg\Api\Query\QueryString\Parameter\ParameterFactory;
  trait LinksTrait {

    private $links;

    private function setLinks(Links $links) {
      $this->links = $links;
    }

    public function getLinks(): Links {
      return $this->links;
    }

    private function buildLinks(string $linksString) {
      $this->setLinks(ParameterFactory::makeParameter('Links', $linksString));
    }

  }
