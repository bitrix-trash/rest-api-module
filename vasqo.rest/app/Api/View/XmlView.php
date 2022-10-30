<?php


namespace Vasqo\Rest\Api\View;


use Vasqo\Rest\Api\Core\View\Interfaces\ViewInterface;

class XmlView implements ViewInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function generate(array $data = []) : string
    {
        $xmlData = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $this->arrayToXml($data, $xmlData);

        header("Content-Type: text/xml");
        return $xmlData->asXML();
    }

    /**
     * @param array $data
     * @param \SimpleXMLElement $xmlData
     */
    protected function arrayToXml(array $data, \SimpleXMLElement &$xmlData) : void
    {
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key;
                }
                $subNode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subNode);
            } else {
                $xmlData->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}