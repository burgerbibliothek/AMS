<?php

namespace App\Ams;

use Burgerbibliothek\ArkManagementTools\Erc;

class Metadata
{

  /**
   * Serialize metadata for saving to Database.
   * Saves metadata into a JSON structure. currently only ERC is supported.
   * @param string $type Metadata scheme. Currently only "erc".
   * @param array $data Data elements.
   * @return string Returns a JSON encoded string.
   */
  public static function serialize(string $type = 'erc', array $data): ?string
  {

    if(!$data){
      return null;
    }

    $metadata = [];

    if ($type == 'erc') {

      $erc = new Erc;

      foreach ($data as $element) {
        $erc->addElement($element['label'], $element['value']);
      }

      $metadata[] = ['type' => 'erc', 'data' => $erc->record(false)];

    }

    return json_encode($metadata);
  }

  /**
   * Deserialize metadata for displaying in backend.
   * @param string $metadata JSON encoded Metadata.
   */
  public static function deserialize(string $metadata, $raw = false)
  {

    $elements = json_decode($metadata, 1);

    foreach ($elements as $element) {

      if ($element['type'] == 'erc') {

        $erc = new Erc;
        $record = $erc->parseKernelMetadata($element['data']);

        if($raw){
          return $record;
        }

        unset($record['erc']);

        $data = [];
        foreach ($record as $key => $value) {
          $data[] = ['label' => $key, 'value' => Erc::decodeElementValue($value)];
        }
      }
    }

    return $data;
  }

  /**
   * 
   */
  public static function erc($metadata)
  {
    $elements = json_decode($metadata, 1);
    foreach ($elements as $element) {
      if ($element['type'] == 'erc') {
        return Erc::decodeElementValue($element['data']);
      }
  }}
   
}
