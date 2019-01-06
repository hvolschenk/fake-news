<?php
  namespace Rwdg\Api\Action\Import;
  use Rwdg\Api\Collection\CollectionFactory;
  use Rwdg\Api\Collection\Pool\Pool as PoolCollection;
  use Rwdg\Api\Model\ModelFactory;
  use Rwdg\Api\Model\Pool\Pool as PoolModel;
  use Rwdg\Api\Query\QueryFactory;
  use Rwdg\Api\Query\QueryString\QueryStringFactory;
  use Rwdg\Config\Connection as Config;
  class Question extends \Rwdg\Api\Action\ActionAbstract {

    private $data;
    private $pools;

    public function execute() {
      $this->buildData();
      $this->buildPools();
      $this->import();
      $this->output();
    }

    private function buildData() {
      $this->setData($this->fetchData());
    }

    private function buildPools() {
      $this->setPools($this->fetchPools());
    }

    private function fetchData(): array {
      $data = [];
      $path = $this->getRootPath() . '/assets/file/titles.csv';
      $skipped = false;
      if (($handle = fopen($path, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
          if ($skipped) {
            $data[] = $row;
          }
          $skipped = true;
        }
      }
      return $data;
    }

    private function fetchPools(): PoolCollection {
      $queryString = QueryStringFactory::makeQueryString(['types' => 'Pool']);
      $model = ModelFactory::makeModel('Pool', $this->getConnection(), $this->getUser());
      $query = QueryFactory::makeQuery('Pool', Config::DRIVER, $queryString, $model);
      $pools = CollectionFactory::makeCollection('Pool', $this->getConnection(), $this->getUser());
      $pools->fetch($query);
      return $pools;
    }

    private function import() {
      foreach ($this->getData() as $row) {
        $model = $this->getModel();
        $model->clear();
        $model->set('question', $row[1]);
        $model->set('answer', strtoupper($row[2]) === 'TRUE' ? 1 : 0);
        $model->create($model->createId(0));
        $this->getRandomPool()->addLink($model->get('id'));
      }
    }

    private function getData(): array {
      return $this->data;
    }

    private function getPools(): PoolCollection {
      return $this->pools;
    }

    private function getRandomPool(): PoolModel {
      $models = $this->getPools()->getModels();
      return $models[array_rand($models)];
    }

    private static function getRootPath(): string {
      return realpath('../..');
    }

    private function setData(array $data) {
      $this->data = $data;
    }

    private function setPools(PoolCollection $pools) {
      $this->pools = $pools;
    }

    private function output() {
      $this->getResponse()->getOutput()->outputModel($this->getModel());
    }

  }
