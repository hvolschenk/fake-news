<?php
  namespace Rwdg\Api\Action;
  use Rwdg\Api\Collection\CollectionInterface;
  use Rwdg\Api\Model\ModelInterface;
  use Rwdg\Api\Model\User\User;
  use Rwdg\Api\Request\RequestInterface;
  use Rwdg\Api\Response\ResponseInterface;
  use Rwdg\Connection\ConnectionInterface;
  abstract class ActionAbstract implements ActionInterface {

    use \Rwdg\Api\Collection\CollectionTrait;
    use \Rwdg\Api\Model\ModelTrait;
    use \Rwdg\Api\Model\User\UserTrait;
    use \Rwdg\Api\Request\RequestTrait;
    use \Rwdg\Api\Response\ResponseTrait;
    use \Rwdg\Connection\ConnectionTrait;

    public function __construct(
      ConnectionInterface $connection,
      RequestInterface $request,
      ResponseInterface $response,
      User $user,
      ModelInterface $model,
      CollectionInterface $collection
    ) {
      $this->setConnection($connection);
      $this->setRequest($request);
      $this->setResponse($response);
      $this->setUser($user);
      $this->setModel($model);
      $this->setCollection($collection);
    }

    public function authorizeAndExecute() {
      if ($this->isActionAuthorized()) {
        $this->execute();
      } else {
        $this->outputAuthorizationError();
      }
    }

    private function isActionAuthorized(): bool {
      $request = $this->getRequest();
      return $this->getUser()->getAuthorization()->hasPrivilege(
        $request->getType(),
        $request->getAction()
      );
    }

    abstract public function execute();

    protected function hookExecutePost() {}

    private function outputAuthorizationError() {
      $user = $this->getUser();
      $output = $this->getResponse()->getOutput();
      $user->setError('UNAUTHORIZED');
      $output->setResponseCode(401);
      $output->outputModel($user);
    }

  }
