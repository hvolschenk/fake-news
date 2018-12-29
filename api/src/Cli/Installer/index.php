<?php
  namespace Rwdg\Cli\Installer;
  require('vendor/autoload.php');
  use Hvolschenk\Cliphf\Input;
  use Hvolschenk\Cliphf\Output;

  Output::format('{bold}{underline}RAWDOG SETUP{/underline}{/bold}{break}');
  $application = new Application();
  $application->install();
  $connection = new Connection();
  $connection->install();
  Output::format('{break}{bold}{green}Successs, {italic}Rawdog{/italic} setup complete!{/green}{/bold}');

