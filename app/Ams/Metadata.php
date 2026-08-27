<?php

namespace App\Ams;

use Burgerbibliothek\ArkManagementTools\Erc;

class Metadata
{
    /**
     * Serialize metadata for saving to Database.
     * Saves metadata into a JSON structure. currently only ERC is supported.
     *
     * @param  array  $data  Data elements.
     * @return string Returns a JSON encoded string.
     */
    public static function serialize(array $data): ?string
    {

        if (empty($data)) {
            return null;
        }

        $erc = new Erc;
        foreach ($data as $element) {
            $erc->add($element['label'], $element['value']);
        }

        return $erc->record(decode: false);
    }

    /**
     * Deserialize metadata for displaying in backend.
     *
     * @param string $metadata ERC Record.
     * @param bool $raw If set to true complete ERC record is returned as decoded String.
     */
    public static function deserialize(string $metadata, bool $raw = false)
    {

        $data = [];

        $erc = new Erc;
        $erc->load($metadata);
        $record = $erc->record;

        if ($raw) {
            return $erc->record();
        }

        unset($record['erc']);
        
        if ($record) {
            foreach ($record as $label => $value) {
                $data[] = ['label' => $label, 'value' => Erc::decodeElementValue($value)];
            }
        }


        return $data;
    }

    public static function erc($metadata)
    {
        $elements = json_decode($metadata, 1);
        foreach ($elements as $element) {
            if ($element['type'] == 'erc') {
                return Erc::decodeElementValue($element['data']);
            }
        }
    }
}
