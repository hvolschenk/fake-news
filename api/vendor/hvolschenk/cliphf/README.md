# CliPh-F
Very simple PHP CLI formatter.

## Installation

Cliphf can either be cloned from the repository on Github or it can be installed via composer. The preferred way is through composer as you will then be able to receive updates easily.

### Composer

```
$ php composer.phar require hvolschenk/cliphf
```

### Git

```
$ git clone https://github.com/righteous-trespasser/cliphf.git
```

## Usage

### Output

You can format output for the command line with the `Output::format` static method. It takes in only one argument and that is the string to be formatted. You can specify formats in an HTML-like syntax as in the following example:

```php
use Hvolschenk\Cliphf;

Output::format('{italic}Checking config{/italic}...');
if ($something === true) {
  Output::format('{bold}{green}Done.{/green}{/bold}')
}
```

### Input

Capuring input is just as simple. You can specify normal text inputs and password inputs through CliPh-F with formatted labels:

```php
$name = Input::text('Please enter your name: ');
$password = Input::password('Secret password: ');
```

Input text can also be formatted and uses the output class to format text:

```php
use Hvolschenk\Cliphf;

$name = Input::text('{bold}{underline}Dangerous input:{/underline}{/bold}');
```

### Rules

There are 10 style rules for text and 8 colors built-in. The rules are:

* blink
  * Creates blinking text
* bold
  * Highlights the text by using a bold font
* dim
  * Dims the text by making the color darker
* hide
  * Creates hidden text (Same color as background, un-highlight-able)
* invert
  * Inverts the backgroud and foreground colors
* italic
  * Emphasises text by making it italic
* strikethrough
  * Draws a line through the text
* underline
  * Draws attention to the text by underlining it
* remove
  * removes all formatting
* break
  * Adds a linebreak

The 8 colors are:

* black
* blue
* cyan
* green
* magenta
* red
* white
* yellow
