<?php

namespace App\Ams;

use Burgerbibliothek\ArkManagementTools\Erc;

class Metadata
{

  /**
   * Serialize metadata for saving to Database.
   * Saves metadata into a JSON structure. currently only ERC is supported.
   */
  public static function serialize($type, $data)
  {

    $metadata = [];

    if ($type == 'erc') {

      $erc = new Erc;

      foreach ($data as $element) {
        $erc->addElement($element['label'], $element['value']);
      }

      $erc->record();
      $metadata[] = ['type' => 'erc', 'data' => $erc->record()];
    }

    return json_encode($metadata);
  }

  /**
   * Deserialize metadata
   */
  public static function deserialize($metadata)
  {

    $elements = json_decode($metadata, 1);

    foreach ($elements as $element) {

      if ($element['type'] == 'erc') {

        $erc = new Erc;

        $record = $erc->parseKernelMetadata($element['data']);
        unset($record['erc']);

        $data = [];
        foreach ($record as $key => $value) {
          $data[] = ['label' => $key, 'value' => Erc::decodeElementValue($value)];
        }
      }
    }

    return $data;
  }
}
