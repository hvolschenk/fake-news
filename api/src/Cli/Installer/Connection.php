<?php
  namespace Rwdg\Cli\Installer;
  use Hvolschenk\Cliphf\Input;
  use Hvolschenk\Cliphf\Output;
  class Connection {

    use \Rwdg\Connection\ConnectionTrait;

    private $configFile;
    private $map = [
      '{host}' => '',
      '{username}' => '',
      '{password}' => '',
      '{database}' => '',
      '{tablePrefix}' => ''
    ];

    public function install() {
      $this->showInformation();
      $this->showPrompts();
      $this->testDatabaseConnection();
      $this->closeDatabaseConnection();
      $this->buildConfigFile();
    }

    private function showInformation() {
      Output::format('{break}{bold}{underline}MySQLi configuration{/underline}{/bold}{break}');
    }

    private function showPrompts() {
      $this->showPromptInformation();
      $this->promptHost();
      $this->promptUsername();
      $this->promptPassword();
      $this->promptDatabase();
      $this->promptTablePrefix();
    }

    private function showPromptInformation() {
      Output::format('{dim}Please fill in your database details in the prompts below.{break}{italic}Rawdog{/italic} will create the tables, default data and configuration file for you.{break}{/dim}');
    }

    private function promptHost() {
      $this->map['{host}'] = Input::text('Host');
    }

    private function promptUsername() {
      $this->map['{username}'] = Input::text('Username');
    }

    private function promptPassword() {
      $this->map['{password}'] = Input::password('Password');
    }

    private function promptDatabase() {
      $this->map['{database}'] = Input::text('Database');
    }

    private function promptTablePrefix() {
      $this->map['{tablePrefix}'] = Input::text('Table prefix');
    }

    private function testDatabaseConnection(): bool {
      $this->buildConnection('Mysql', 'Pdo');
      $map = $this->map;
      if ($this->getConnection()->connect($map['{host}'], $map['{username}'],
        $map['{password}']) === false) {
        self::showDatabaseConnectionError();
      }
      return true;
    }

    private static function showDatabaseConnectionError() {
      Output::format('{bold}{red}Please check the database settings entered, the specified host could not be connected to.{/red}{/bold}');
      exit(1);
    }

    private function closeDatabaseConnection() {
      $this->getConnection()->disconnect();
    }

    private function buildConfigFile() {
      Output::format('Building config file. ', false);
      $this->createAndOpenConfigFile();
      $this->buildConfigFileContent();
      $this->closeConfigFile();
      Output::format('{bold}{green}Done.{/green}{/bold}');
    }

    private function createAndOpenConfigFile() {
      $this->configFile = fopen(self::getConfigFilePath(), 'w+');
    }

    private static function getConfigFilePath(): string {
      return 'src/Config/Connection.php';
    }

    private function buildConfigFileContent() {
      fwrite($this->configFile,
        $this->replaceConfigValues($this->getConfigTemplateContent()));
    }

    private function getConfigTemplateContent(): string {
      return file_get_contents('src/Config/Connection.template');
    }

    private function replaceConfigValues(string $fileContent): string {
      return str_replace(array_keys($this->map), $this->map, $fileContent);
    }

    private function closeConfigFile() {
      fclose($this->configFile);
    }
  }
