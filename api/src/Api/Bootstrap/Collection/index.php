<?php
  namespace Rwdg\Api\Bootstrap\Collection;
  use Rwdg\Api\Collection\CollectionFactory;

  $collectionBootstrap = new Collection($request->getType(), $connection, $user);
  $collection = $collectionBootstrap->getCollection();
  unset($collectionBootstrap);
