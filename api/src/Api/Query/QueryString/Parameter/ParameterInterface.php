<?php
  namespace Rwdg\Api\Query\QueryString\Parameter;
  interface ParameterInterface {

    public function __construct(string $parameterString);

    public function getValue(): array;

  }
