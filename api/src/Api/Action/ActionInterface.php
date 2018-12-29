<?php
  namespace Rwdg\Api\Action;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Request\RequestInterface;
  use Rwdg\Api\Response\ResponseInterface;
  use Rwdg\Connection\ConnectionInterface;
  interface ActionInterface {

    public function __construct(
      ConnectionInterface $connection,
      RequestInterface $request,
      ResponseInterface $response,
      User $user,
      ModelInterface $model,
      CollectionInterface $collection
    );

    public function execute();

  }
