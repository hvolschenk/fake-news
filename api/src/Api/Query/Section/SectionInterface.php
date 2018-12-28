<?php
  namespace Rwdg\Api\Query\Section;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Query\QueryString\QueryString;
  interface SectionInterface {

    public function __construct(string $type, QueryString $queryString, ModelInterface $model,
    int $parentId = null);

    public function getSection(): string;

  }
