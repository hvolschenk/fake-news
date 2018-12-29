<?php
  namespace Rwdg\Api\Response\Output;
  trait OutputTrait {

    private $output;

    private function setOutput(OutputInterface $output) {
      $this->output = $output;
    }

    public function getOutput(): OutputInterface {
      return $this->output;
    }

  }
