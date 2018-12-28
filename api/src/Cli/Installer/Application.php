<?php
  namespace Rwdg\Cli\Installer;
  use Hvolschenk\Cliphf\Input;
  use Hvolschenk\Cliphf\Output;
  class Application {

    private $configFile;
    private $map = [
      '{name}' => ''
    ];

    public function install() {
      $this->showInformation();
      $this->showPrompts();
      $this->buildConfigFile();
    }

    private function showInformation() {
      Output::format('{bold}{underline}Application configuration{/underline}{/bold}{break}');
      Output::format('{dim}Please fill in your application details in the prompts below.{break}{italic}Rawdog{/italic} will create the configuration file for you.{break}{/dim}');
    }

    private function showPrompts() {
      $this->promptName();
    }

    private function promptName() {
      $this->map['{name}'] = Input::text('Name');
    }

    private function buildConfigFile() {
      Output::format('{break}Building config file. ', false);
      $this->createAndOpenConfigFile();
      $this->buildConfigFileContent();
      $this->closeConfigFile();
      Output::format('{bold}{green}Done.{/green}{/bold}');
    }

    private function createAndOpenConfigFile() {
      $this->configFile = fopen(self::getConfigFilePath(), 'w+');
    }

    private function buildConfigFileContent() {
      fwrite($this->configFile,
        $this->replaceConfigValues($this->getConfigTemplateContent()));
    }

    private function getConfigTemplateContent(): string {
      return file_get_contents('src/Config/Application.template');
    }

    private function replaceConfigValues(string $fileContent): string {
      return str_replace(array_keys($this->map), $this->map, $fileContent);
    }

    private static function getConfigFilePath(): string {
      return 'src/Config/Application.php';
    }

    private function closeConfigFile() {
      fclose($this->configFile);
    }

  }

