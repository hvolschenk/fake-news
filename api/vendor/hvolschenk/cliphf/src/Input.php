<?php
  namespace Hvolschenk\Cliphf;
  class Input {

    private static function testBash() {
      $command = "/usr/bin/env bash -c 'echo OK'";
      if (rtrim(shell_exec($command)) !== 'OK') {
        Output::format('{bold}{red}Can\'t invoke bash{/red}{/bold}');
        exit(1);
      }
      return true;
    }

    private static function getInput(string $label, bool $silent = false) {
      $flag = $silent === true ? '-s' : '';
      $command = "/usr/bin/env bash -c 'read $flag -p \"" .
        addslashes(Output::format("{dim}{bold}$label: {/bold}{/dim}", false)) .
          "\" mytext && echo \$mytext'";
      return self::testBash() === true ? rtrim(shell_exec($command)) : '';
    }

    public static function text(string $label) {
      return self::getInput($label);
    }

    public static function password(string $label,
      string $after = '*****'): string {
      $password = self::getInput($label, true);
      Output::format($after);
      return $password;
    }

  }
?>
