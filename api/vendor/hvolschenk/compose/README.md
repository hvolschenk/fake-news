# Compose
PHP function composition

The composition can either be run directly from the static method or used as a trait in a class.

### Directly

```php
<?php
  namespace Test\Test;
  require('vendor/autoload.php');

  function addA(string $string) {
    return "{$string}a";
  }

  function addB(string $string) {
    return "{$string}b";
  }

  function addC(string $string) {
    return "{$string}c";
  }

  echo Hvolschenk\Utils\Compose\Compose::compose('Value',
    ['addA', 'addB', 'addC']); // ValueABC
?>
```

### As a trait

#### With static methods

```php
<?php
  class StringAdder {
    use \Hvolschenk\Traits\Compose;

    private $value;

    public function __construct(string $value) {
      $this->setValue($value);
    }

    public function getValue(): string {
      return $this->value;
    }

    private function setValue(string $value) {
      $this->value = self::composeValue($value);
    }

    private static function composeValue(string $value): string {
      return self::compose($value, ['addA', 'addB', 'addC']);
    }

    private static function addA(string $string) {
      return "{$string}a";
    }

    private static function addB(string $string) {
      return "{$string}b";
    }

    private static function addC(string $string) {
      return "{$string}c";
    }
  }

  $stringAdder = new StringAdder('Value');
  echo $stringAdder->getValue(); // ValueABC
?>
```

#### With non-static methods

```php
<?php
  class StringAdder {
    use \Hvolschenk\Traits\Compose;

    private $value;
    private $separator = '.';

    public function __construct(string $value) {
      $this->setValue($value);
    }

    public function getValue(): string {
      return $this->value;
    }

    private function setValue(string $value) {
      $this->value = self::composeValue($value);
    }

    private function composeValue(string $value): string {
      return $this->composeNonStatic($value, ['addA', 'addB', 'addC']);
    }

    private function addA(string $string) {
      return "{$string}a{$this->separator}";
    }

    private function addB(string $string) {
      return "{$string}b{$this->separator}";
    }

    private function addC(string $string) {
      return "{$string}c{$this->separator}";
    }
  }

  $stringAdder = new StringAdder('Value');
  echo $stringAdder->getValue(); // ValueA.B.C.
?>
```

#### With static and non-static methods

```php
<?php
  class StringAdder {
    use \Hvolschenk\Traits\Compose;

    private $value;
    private $separator = '.';

    public function __construct(string $value) {
      $this->setValue($value);
    }

    public function getValue(): string {
      return $this->value;
    }

    private function setValue(string $value) {
      $this->value = self::composeValue($value);
    }

    private function composeValue(string $value): string {
      return $this->composeMixed($value, [['self', 'addA'], ['self', 'addB'],
        [$this, 'addC']]);
    }

    private static function addA(string $string) {
      return "{$string}a";
    }

    private static function addB(string $string) {
      return "{$string}b";
    }

    private function addC(string $string) {
      return "{$string}c{$this->separator}";
    }
  }

  $stringAdder = new StringAdder('Value');
  echo $stringAdder->getValue(); // ValueABC.
?>
```
