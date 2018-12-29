<?php
  namespace Rwdg\Api\Response;
  use Rwdg\Api\Response\Output\OutputInterface;
  class Response extends ResponseAbstract {

    use \Rwdg\Api\Response\Output\OutputTrait;

    public function __construct(OutputInterface $output) {
      $this->setOutput($output);
    }

  }
