<?php
  namespace Rwdg\Exception;
  abstract class ExceptionAbstract extends \Exception
  implements ExceptionInterface {

    private $defaultException = [
      'code' => 600000,
      'message' => 'Unknown exception'
    ];

    protected $exceptions = [];

    public function __construct(string $name = '', int $code = 0,
    Throwable $previous = null) {
      $this->setException($name);
      parent::__construct($this->getExceptionMessage(), $this->getExceptionCode(), $previous);
    }

    private function setException(string $name) {
      $definition = $this->getExceptionDefinition($name);
      $this->buildCode($definition);
      $this->buildMessage($definition);
    }

    private function getExceptionDefinition(string $name): array {
      return $this->exceptions[$name] ?? $this->defaultException;
    }

    private function setCode(string $code) {
      $this->code = $code;
    }

    private function buildCode(array $definition) {
      $this->setCode(self::getExceptionCodeFromDefinition($definition));
    }

    private function getExceptionCode(): string {
      return $this->code;
    }

    private function setMessage(string $message) {
      $this->message = $message;
    }

    private function buildMessage(array $definition) {
      $this->setMessage(self::getExceptionMessageFromDefinition($definition));
    }

    private function getExceptionMessage(): string {
      return $this->message;
    }

    private static function getExceptionCodeFromDefinition(array $definition): int {
      return $definition['code'];
    }

    private static function getExceptionMessageFromDefinition(array $definition): string {
      return $definition['message'];
    }

  }
