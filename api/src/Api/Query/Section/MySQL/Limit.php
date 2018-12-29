<?php
  namespace Rwdg\Api\Query\Section\MySQL;
  class Limit extends \Rwdg\Api\Query\Section\SectionAbstract {

    protected function buildSection() {
      $limit = $this->getQueryString()->getLimitValue();
      $this->setSection('LIMIT ' . $this->addParameter($limit['offset']) . ', ' .
        $this->addParameter($limit['limit']) . ' ');
    }

  }
