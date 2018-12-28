<?php
  namespace Rwdg\Api\Request\Parameter;
  interface ParameterInterface {

    public function __construct();

    public function getValue(): array;

  }
