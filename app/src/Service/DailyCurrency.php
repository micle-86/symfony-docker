<?php

namespace App\Service;

use App\Entity\Currency;

class DailyCurrency
{
  const NODE_NAME = 'Valute';
  private $url;

  public function setUrl(string $url)
  {
    $this->url = $url;
  }

  /**
   * @param string $xmlString
   * @return Currency|null
   */
  private function getCurrencyFromXML(string $xmlString): ?Currency
  {
    $xml = new \SimpleXMLElement($xmlString);
    $currency = new Currency();
    $currency->setName($xml->CharCode);
    $currency->setRate((float)$xml->Value);
    return $currency;
  }

  /**
   * @return \Generator|null
   */
  public function getCurrency(): ?\Generator
  {
    $xml = new \XMLReader();
    $xml->open($this->url);
    $this->goToNode($xml, self::NODE_NAME);
    do {
      if ($xml->name !== self::NODE_NAME) {
        break;
      }
      yield $this->getCurrencyFromXML($xml->readOuterXml());
    } while ($xml->next(self::NODE_NAME));
    $xml->close();
  }

  /**
   * @param \XMLReader $xml
   * @param string $nodeName
   */
  private function goToNode(\XMLReader &$xml, string $nodeName): void
  {
    while ($xml->read()) {
      if ($xml->name == $nodeName) {
        return;
      }
    }
  }
}