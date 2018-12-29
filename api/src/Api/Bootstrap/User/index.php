<?php
  $user = \Rwdg\Api\Model\ModelFactory::makeModel('User', $connection, null);
  $user->fetchFromAuthorizationToken($request->getAuthorization());
