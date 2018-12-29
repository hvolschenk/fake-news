<?php
  namespace Rwdg\Api\Bootstrap\Model;

  $modelBootstrap = new Model($request->getGET()->getType(), $connection, $user);
  $model = $modelBootstrap->getModel();
  unset($modelBootstrap);
