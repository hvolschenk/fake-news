<?php
  $action = \Rwdg\Api\Action\ActionFactory::makeAction(
    $request->getAction(),
    $request->getType(),
    $connection,
    $request,
    $response,
    $user,
    $model,
    $collection
  );
  $action->authorizeAndExecute();
  unset($action);
