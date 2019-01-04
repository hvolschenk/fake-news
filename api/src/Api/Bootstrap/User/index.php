<?php
  $user = \Rwdg\Api\Model\ModelFactory::makeModel('User', $connection, null);
  $user->fetchFromSessionId(session_id());
