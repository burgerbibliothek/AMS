<?php

namespace App\Ams;
use Burgerbibliothek\ArkManagementTools\Erc;

class Metadata
{
    /**
     * Serialize metadata for saving to Database.
     * 
     * @param  array  $data  Data elements.
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

        /** Return ERC as text record */
        if ($raw) {
            return $erc->record();
        }

        /** Remove first entry in array which only contains the "erc" key */
        unset($record[0]);

        if (empty($record) === false) {
            foreach ($record as $r) { 
                $data[] = ['label' => key($r), 'value' => Erc::decodeElementValue($r[key($r)])];
            }
        }

        return $data;
    }

}
