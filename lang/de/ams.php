<?php

return [

    /**
     * Navigation
     */
    'navigation_settings' => 'Einstellungen',

    /*
     * Actions
     */
    'button_delete' => 'Löschen',
    'button_new' => ':thing erstellen',

    /*
     * ARK Resource
     */
    'ark_resource_section_basic' => 'Grundeinstellungen',
    'ark_resource_ark' => 'Archival Resource Key (ARK)',
    'ark_resource_ark_list' => 'ARK',
    'ark_resource_naan' => 'NAAN',
    'ark_resource_uri' => 'Uniform Resource Identifier (URI)',
    'ark_resource_uri_list' => 'URI',
    'ark_resource_status' => 'HTTP-Status',
    'ark_resource_section_metadata' => 'Metadaten',
    'ark_resource_erc_who' => 'Wer',
    'ark_resource_erc_who_help' => 'Eine verantwortliche Person oder Partei.',
    'ark_resource_erc_what' => 'Was',
    'ark_resource_erc_what_help' => 'Ein Name oder ein anderer nutzerorientierter Bezeichner.',
    'ark_resource_erc_when' => 'Wann',
    'ark_resource_erc_when_help' => 'Ein wichtiges Datum im Lebenszyklus des Objekts.',
    'ark_resource_erc_where' => 'Wo',
    'ark_resource_erc_where_help' => 'Ein Standort oder ein systemorientierter Bezeichner.',
    'ark_resource_erc_note' => 'Notiz',
    'ark_resource_erc_note_help' => 'Eine Freitextnotiz zum Datensatz.',
    'ark_resource_dialog_delete_heading' => 'Sind Sie sicher?',
    'ark_resource_dialog_delete_desc' => 'Dadurch wird der ARK dauerhaft gelöscht und kann nicht rückgängig gemacht werden.',
    'ark_resource_dialog_delete_submit' => 'Ja, ich bin sicher.',
    'ark_resource_actions_import' => 'CSV-Import',
    'ark_resource_actions_create' => 'ARK erstellen',
    'ark_resource_shoulders' => 'Shoulder',
    'ark_resource_import_modalheading' => 'CSV-Import',
    'ark_resource_import_submitactionlabel' => 'Import starten',
    'ark_resource_import_naan' => 'NAAN',
    'ark_resource_import_naan_helptext' => 'Für Einträge ohne ARK wird der ausgewählte NAAN verwendet, um neue ARKs zuzuweisen.',
    'ark_resource_import_shoulder' => 'Shoulder',
    'ark_resource_import_shoulder_helptext' => 'Optionale Auswahl eines Shoulders für die Zuweisung neuer ARKs.',
    'ark_resource_import_skip' => 'Einträge mit vorhandenen URIs überspringen.',
    'ark_resource_import_skip_hint' => 'Wenn diese Option ausgewählt ist, werden Einträge, die bereits über einen identischen URI verfügen, übersprungen.',
    'ark_resource_import_ercwhere' => '"Where"-Story mit ARK hinzufügen.',
    'ark_resource_import_ercwhere_helptext' => 'Wenn diese Option ausgewählt ist, wird eine "Where"-Story, die den ARK enthält, zum ERC-Datensatz hinzugefügt (inkl. Name Mapping Authority).',
    'ark_resource_revision_title' => 'Revisionen',
    'ark_resource_revision_data' => 'Daten',
    'ark_resource_revision_moddate' => 'Revisionsdatum',
    'ark_resource_import_mergestrategy' => 'Metadaten Zusammenführungsstrategie',
    'ark_resource_import_mergestrategy_helptext' => 'Wähle die Strategie, welche bei der Zusammenführung von Metadaten verwendet werden soll.',
    'ark_resource_import_mergestrategy_keep' => 'Behalten: Bestehende Werte erhalten, neue Werte / Felder ergänzen.',
    'ark_resource_import_mergestrategy_overwrite' => 'Überschreiben: Alle Felder werden überschrieben / gelöscht.',
    /*
     * Minter Resource
     */
    'minter_resource_section_minter' => 'Minter-Einstellungen',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Name',
    'minter_resource_name_help' => 'Bezeichnung des Minters',
    'minter_resource_name_placeholder' => 'z. B. "alphanumerisch ohne Vokale"',
    'minter_resource_xdigits' => 'Zeichenrepertoire',
    'minter_resource_xdigits_help' => 'Zulässige Zeichen sind Buchstaben, Zahlen oder die folgenden Zeichen: = ~ * + @ _ $. Doppelte Zeichen werden beim Speichern entfernt. Die Zeichen werden sortiert gespeichert.',
    'minter_resource_xdigits_placeholder' => 'z. B. 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Ungültige Zeichen erkannt.',
    'minter_resource_xdigits_length_error' => 'Damit der NCDA funktioniert, muss das Zeichenrepertoire mindestens :number Zeichen umfassen.',
    'minter_resource_length' => 'ID-Länge',
    'minter_resource_length_help' => 'Die ID-Länge sollte die Anzahl der Zeichen im Zeichenrepertoire nicht überschreiten, damit der NCDA funktioniert.',
    'minter_resource_lenght_error' => 'Damit der NCDA funktioniert, darf die ID-Länge :number nicht überschreiten.',
    'minter_resource_ncda' => 'Prüfzeichen hinzufügen',
    'minter_resource_ncda_help' => 'NCDA (Noid Check Digit Algorithm) ist ein Algorithmus, der verwendet wird, um ein Prüfzeichen für einen Noid (nice opaque identifier) zu berechnen oder zu validieren. Er kann verwendet werden, um sicherzustellen, dass eine ID keine Transkriptionsfehler enthält.',
    'minter_resource_dialog_delete_heading' => 'Sind Sie sicher?',
    'minter_resource_dialog_delete_desc' => 'Sie können keine neuen ARKs für NAANs generieren, denen diese Einstellung zugeordnet war.',
    'minter_resource_dialog_delete_submit' => 'Ja, ich bin sicher.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Grundeinstellungen',
    'naan_resource_naan' => 'Name Assigning Authority Number (NAAN)',
    'naan_resource_naan_helpertext' => 'Details zum Erhalt eines NAAN finden Sie auf der Website *[arks.org](https://arks.org/about/ark-naans-and-systems/)*',
    'naan_resource_nma' => 'Name Mapping Authority (NMA)',
    'naan_resource_nma_helpertext' => 'z. B. https://n2t.net/',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Beschreibung',
    'naan_resource_desc_helpertext' => 'Bezeichnung für interne Zwecke',
    'naan_resource_minter' => 'Minter',
    'naan_resource_shoulders' => 'Shoulders',
    'naan_resource_shoulder' => 'Shoulder',
    'naan_resource_dialog_delete_heading' => 'Sind Sie sicher?',
    'naan_resource_dialog_delete_desc' => 'Sie können keine neuen ARKs für diesen NAAN generieren.',
    'naan_resource_dialog_delete_submit' => 'Ja, ich bin sicher.',
    'naan_resource_spt' => 'Suffix Passthrough',
    'naan_resource_spt_help' => 'Wenn diese Option aktiviert ist, wird das Suffix an das Ende der Standort-URL (Ziel-URL) des Identifikators angehängt.',

    /*
     * Status Resource
     */
    'status_resource_section' => 'Grundeinstellungen',
    'status_resource_code' => 'Statuscode',
    'status_resource_code_help' => 'Codes wie in RFC 9110 definiert',
    'status_resource_message' => 'Meldung',
    'status_resource_message_help' => 'Meldung, die auf der Fehlerseite angezeigt wird.',

    /*
     * Import Resource
     */
    'import_resource_navigationlabel' => 'Importvorgänge',
    'import_resource_export_list' => 'Liste exportieren',
    'import_resource_dialog_delete_heading' => 'Sind Sie sicher?',
    'import_resource_dialog_delete_desc' => 'Dadurch werden die Importeinträge dauerhaft gelöscht und können nicht rückgängig gemacht werden.',
    'import_resource_dialog_delete_submit' => 'Ja, ich bin sicher.',
    'import_resource_successfull_title' => 'Erfolreiche Verarbeitungen',
    'import_resource_unsuccessfull_title' => 'Fehlschlagene Verarbeitungen',
    'import_resource_unsuccessfull_table_data' => 'Datensatz',
    'import_resource_unsuccessfull_table_error' => 'Fehlermeldung',
    'import_resource_unsuccessfull_table_created_at' => 'Erstellt am',
    'import_resource_details_total_rows' => 'Total Verarbeitungen',
    'import_resource_details_successfull_rows' => 'Erfolgreiche Verarbeitungen',
    'import_resource_details_created_at' => 'Gestartet am',
    'import_resource_details_completed_at' => 'Beendet am',
    'ams.navigation_settings' => 'Einstellungen',


];
