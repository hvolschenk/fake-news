<?php
  namespace Rwdg\Api\Request\Parameter\Headers;
  class Headers extends \Rwdg\Api\Request\Parameter\ParameterAbstract {

    private $requestMethods = [
      'GET' => 'Read',
      'PUT' => 'Update',
      'POST' => 'Create',
      'DELETE' => 'Delete'
    ];

    private $contentTypes = [
      'application/json' => 'JSON',
      'application/xml' => 'XML',
      'application/yaml' => 'YML'
    ];

    public function getAction(): string {
      return $this->convertRequestMethod($this->getRequestMethod());
    }

    public function getAuthorization(): string {
      $value = $this->getValue();
      return $value['AUTHORIZATION'] ?? $value['X-RAWDOG-AUTHORIZATION'] ?? '';
    }

    public function getContentType(): string {
      return $this->convertContentType($this->getRawContentType());
    }

    public function getRawContentType(): string {
      return $this->getValue()['Content-Type'] ?? 'application/json';
    }

    private function convertRequestMethod(string $requestMethod): string {
      return $this->requestMethods[$requestMethod] ?? 'Read';
    }

    private function getRequestMethod(): string {
      return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    private function convertContentType(string $contentType): string {
      return $this->contentTypes[$contentType] ?? 'JSON';
    }

    protected function buildValue() {
      $this->setValue(self::parseValue(apache_request_headers() ?? []));
    }

    static private function parseValue(array $value) {
      return array_change_key_case($value, CASE_UPPER);
    }

  }
