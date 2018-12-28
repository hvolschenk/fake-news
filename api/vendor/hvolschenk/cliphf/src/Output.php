<?php
  namespace Hvolschenk\Cliphf;
  class Output {

    use \Hvolschenk\Traits\Compose;

    private static $map = [
      '{blink}' => "\e[5m",
      '{/blink}' => "\e[25m",
      '{bold}' => "\e[1m",
      '{/bold}' => "\e[21m",
      '{dim}' => "\e[2m",
      '{/dim}' => "\e[22m",
      '{hide}' => "\e[8m",
      '{/hide}' => "\e[28m",
      '{invert}' => "\e[7m",
      '{/invert}' => "\e[27m",
      '{italic}' => "\e[3m",
      '{/italic}' => "\e[23m",
      '{strikethrough}' => "\e[9m",
      '{/strikethrough}' => "\e[29m",
      '{underline}' => "\e[4m",
      '{/underline}' => "\e[24m",
      '{black}' => "\e[30m",
      '{/black}' => "\e[39m",
      '{blue}' => "\e[34m",
      '{/blue}' => "\e[39m",
      '{cyan}' => "\e[36m",
      '{/cyan}' => "\e[39m",
      '{green}' => "\e[32m",
      '{/green}' => "\e[39m",
      '{magenta}' => "\e[35m",
      '{/magenta}' => "\e[39m",
      '{red}' => "\e[31m",
      '{/red}' => "\e[39m",
      '{white}' => "\e[97m",
      '{/white}' => "\e[39m",
      '{yellow}' => "\e[33m",
      '{/yellow}' => "\e[39m",
      '{remove}' => "\e[0m",
      '{break}' => "\n"
    ];

    public static function format(string $message, bool $break = true) {
      echo self::compose($message, self::getFunctionsList($break));
    }

    public static function _applyFormatting(string $message): string {
      return str_replace(array_keys(self::$map), self::$map, $message);
    }

    public static function _endFormatting(string $message): string {
      return $message . self::$map['{remove}'];
    }

    public static function _marryNeighbours(string $message): string {
      return str_replace('me\[', ';', $message);
    }

    public static function _addBreak(string $message): string {
      return $message . self::$map['{break}'];
    }

    private static function getFunctionsList(bool $break) {
      $functions = ['_applyFormatting', '_endFormatting', '_marryNeighbours'];
      if ($break) {
        $functions[] = '_addBreak';
      }
      return $functions;
    }

  }
?>
