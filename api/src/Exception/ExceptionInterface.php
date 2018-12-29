<?php
  namespace Rwdg\Exception;
  interface ExceptionInterface {

    public function __construct(string $message, int $code,
    Throwable $previous);

  }

