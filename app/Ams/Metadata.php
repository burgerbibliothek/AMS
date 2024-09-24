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

      foreach ($data as $story) {
        $erc->addStory([$story['data']['who'], $story['data']['what'], $story['data']['when'], $story['data']['where']], $story['data']['prefix']);
      }

      $erc->record();
      $metadata[] = ['type' => 'erc', 'data' => $erc->record()];
    }

    return json_encode($metadata);
  }

  public static function deserialize($metadata)
  {

    $metadata = json_decode($metadata, 1);

    foreach ($metadata as $entry) {
      if ($entry['type'] == 'erc') {

        $erc = Erc::parseKernelMetadata($entry['data']);
        unset($erc['erc']);

        $stories = array_chunk($erc, 4, true);
        $data = [];
        $prefix = null;

        foreach ($stories as $story) {
          if (str_contains(array_key_first($story), '-')) {
            $prepos = strrpos(array_key_first($story), '-');
            $prefix = substr(array_key_first($story), 0, $prepos);
            foreach ($story as $sk => $s) {
              $pos = strrpos($sk, '-');
              $story[substr($sk, $pos + 1, strlen($sk))] = $s;
              unset($story[$sk]);
            }
            $story['prefix'] = $prefix;
          }
          $data['stories'][] = ["type" => "story", "data" => $story];
        }

        return $data;
      }
    }
  }
}
