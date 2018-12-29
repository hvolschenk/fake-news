<?php
  namespace Rwdg\Api\Query\QueryString\Parameter\Links;
  use Rwdg\Api\Query\QueryString\QueryStringFactory;
  class Links extends \Rwdg\Api\Query\QueryString\Parameter\ParameterAbstract {

    const LINKS_ITEMS_DIVIDER = '|||';
    const LINKS_ITEMS_DIVIDER_TWO = '/';
    const LINK_ITEM_DIVIDER = '||';
    const LINK_ITEM_DIVIDER_TWO = '*';
    const QUERY_STRING_DIVIDER = '|';

    protected function buildValue() {
      $this->buildLinks();
    }

    public function getValue(): array {
      return $this->value;
    }

    private static function getLinkValue(QueryString $link): array {
      return $link->getValue();
    }

    protected function buildLinks() {
      $parameterString = $this->getParameterString();
      if (!empty($parameterString)) {
        foreach (self::splitLinksIntoItems($parameterString) as $item) {
          $this->buildLink($item);
        }
      }
    }

    private function buildLink(string $link) {
      $nameAndQueryString = self::splitItemIntoNameAndQueryString($link);
      $this->value[$nameAndQueryString[0]] =
        QueryStringFactory::makeQueryString(self::getLinkQueryString($nameAndQueryString[1] ?? ''));
    }

    private static function getLinkQueryString(
    string $rawQueryString): array {
      parse_str(self::replaceQueryStringDivider($rawQueryString), $queryString);
      return $queryString;
    }

    private static function splitLinksIntoItems(string $links): array {
      $divider = strpos($links, self::LINK_ITEM_DIVIDER) > -1 ? self::LINKS_ITEMS_DIVIDER :
        self::LINKS_ITEMS_DIVIDER_TWO;
      return explode($divider, $links);
    }

    private static function splitItemIntoNameAndQueryString(
    string $item): array {
      $divider = strpos($item, self::QUERY_STRING_DIVIDER) > -1 ? self::LINK_ITEM_DIVIDER :
        self::LINK_ITEM_DIVIDER_TWO;
      return explode($divider, $item);
    }

    private static function replaceQueryStringDivider(
    string $queryString): string {
      return str_replace(self::QUERY_STRING_DIVIDER, '&', $queryString);
    }

  }
