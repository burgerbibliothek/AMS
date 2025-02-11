<?php

namespace App\Ams;

use Burgerbibliothek\ArkManagementTools\Erc;

class Metadata
{
    /**
     * Serialize metadata for saving to Database.
     * Saves metadata into a JSON structure. currently only ERC is supported.
     *
     * @param  string  $type  Metadata scheme. Currently only "erc".
     * @param  array  $data  Data elements.
     * @return string Returns a JSON encoded string.
     */
    public static function serialize(string $type, array $data): string
    {

        if (empty($data)) {
            return null;
        }

        $metadata = [];

        if ($type === 'erc') {

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
     *
     * @param  string  $metadata  JSON encoded Metadata.
     * @param  bool  $raw  If set to TRUE complete ERC record is returned as array.
     */
    public static function deserialize(string $metadata, bool $raw = false)
    {

        $data = [];
        $elements = json_decode($metadata, 1);

        /** Check if JSON could be decoded */
        if ($elements) {

            /** Iterate elements */
            foreach ($elements as $element) {

                if (! empty($element['type']) && $element['type'] == 'erc' && ! empty($element['data'])) {

                    $record = Erc::parseRecord($element['data']);

                    if ($raw) {
                        return $record;
                    }

                    unset($record['erc']);

                    if ($record) {
                        foreach ($record as $label => $value) {
                            $data[] = ['label' => $label, 'value' => Erc::decodeElementValue($value)];
                        }
                    }
                }
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
