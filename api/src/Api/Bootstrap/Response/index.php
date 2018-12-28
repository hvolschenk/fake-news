<?php
  $output = \Rwdg\Api\Response\Output\OutputFactory::makeOutput('JSON');
  $response = \Rwdg\Api\Response\ResponseFactory::makeResponse($output);
  unset($output);
