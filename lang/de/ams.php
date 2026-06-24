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
    'button_new' => 'Erstelle :thing',

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
    'ark_resource_erc_who' => 'Who',
    'ark_resource_erc_who_help' => 'Eine verantwortliche Person oder Stelle.',
    'ark_resource_erc_what' => 'What',
    'ark_resource_erc_what_help' => 'Ein Name oder ein andere menschengerechte Identifikator.',
    'ark_resource_erc_when' => 'When',
    'ark_resource_erc_when_help' => 'Ein für den Lebenszyklus des Objekts wichtiges Datum.',
    'ark_resource_erc_where' => 'Where',
    'ark_resource_erc_where_help' => 'Eine Adresse oder ein systemorientierter Identifikator.',
    'ark_resource_erc_note' => 'Bemerkung',
    'ark_resource_erc_note_help' => 'Freitextfeld zum Datensatz.',
    'ark_resource_dialog_delete_heading' => 'Bist du sicher?',
    'ark_resource_dialog_delete_desc' => 'Dadurch wird der ARK unwiederbringlich gelöscht.',
    'ark_resource_dialog_delete_submit' => 'Ja, ich bin sicher',
    'ark_resource_actions_import' => 'CSV-Import',
    'ark_resource_actions_create' => 'ARK Erstellen',
    'ark_resource_shoulders' => 'Shoulder',
    'ark_resource_import_modalheading' => 'CSV-Import',
    'ark_resource_import_submitactionlabel' => 'Import starten',
    'ark_resource_import_naan' => 'NAAN',
    'ark_resource_import_naan_helptext' => 'Für Einträge ohne ARK wird die NAAN für das erstellen neuer ARKs verwendet.',
    'ark_resource_import_shoulder' => 'Shoulder',
    'ark_resource_import_shoulder_helptext' => 'Optionale Auswahl einer Shoulder für die Erstellung von ARKs.',
    'ark_resource_import_skip' => 'Überspringe Einträge mit existierender URI',
    'ark_resource_import_skip_hint' => 'Wenn diese Option angewählt wird, dann werden Einträge, für welche die identische URI bereits in der Datenbank existiert, übersprungen.',
    'ark_resource_import_emptydatadelete' => 'Metadaten löschen, wenn Feld leer ist',
    'ark_resource_import_emptydatadelete_helptext' => 'Wenn die Option angewählt wird, dann werden die Metadaten eines bestehenden Eintrags gelöscht, wenn die entsprechende Zeile leer ist.',
    'ark_resource_import_ercwhere' => 'Ergänze “where” story mit ARK.',
    'ark_resource_import_ercwhere_helptext' => 'Wenn diese Option angewählt wird, dann wird bei der “where” story der generierte ARK (inkl. Name Mapping Authority) in den Metadaten ergänzt.',
    'ark_resource_revision_title' => 'Mutationen',
    'ark_resource_revision_data' => 'Daten',
    'ark_resource_revision_moddate' => 'Mutationsdatum',

    /*
     * Minter Resource
     */
    'minter_resource_section_minter' => 'Minter Einstellungen',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Name',
    'minter_resource_name_help' => 'Beschriftung des Minter',
    'minter_resource_name_placeholder' => 'z. B. “alphanumerisch ohne Vokale”',
    'minter_resource_xdigits' => 'Zeichenrepetoire',
    'minter_resource_xdigits_help' => 'Erlaubte Zeichen sind Buchstaben, Ziffern oder die folgenden Sonderzeichen: = ~ * + @ _ $. Doppelte Zeichen werden dedupliziert. Die Zeichen werden sortiert abgespeichert.',
    'minter_resource_xdigits_placeholder' => 'z. B. 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Unerlaubte Zeichen wurden festgestellt.',
    'minter_resource_xdigits_length_error' => 'Damit der NCDA funktioniert, muss das Zeichenrepetoire mindestens eine Anzahl von :number Zeichen aufweisen.',
    'minter_resource_length' => 'ID-Länge',
    'minter_resource_length_help' => 'Die ID-Lännge sollte nicht länger als die Anzahl Zeichen in Zeichenrepetoire sein, damit der NCDA funktioniert.',
    'minter_resource_lenght_error' => 'Damit der NCDA verwendet werden kann, darf die ID-Länge nicht mehr als :number Stellen aufweisen.',
    'minter_resource_ncda' => 'Verwende NCDA',
    'minter_resource_ncda_help' => 'NCDA (Noid Check Digit Algorithm) ist ein Algorithmus, zur Errechnung oder Überprüfung eines noid (nice opaque identifier) Kontrollzeichens. Dieser kann verwendet werden um zu überprüfen ob ein ARK Transkriptionsfehler aufweist. ',
    'minter_resource_dialog_delete_heading' => 'Bist du sicher?',
    'minter_resource_dialog_delete_desc' => 'Dadurch wird es nicht mehr möglich sein, neue ARKs für NAANs zu generieren bei welchen die Einstellungen assoziert sind.',
    'minter_resource_dialog_delete_submit' => 'Ja, ich bin sicher.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Grundeinstellungen',
    'naan_resource_naan' => 'Name Assigning Authority Number (NAAN)',
    'naan_resource_naan_helpertext' => 'Das Vorgehen zur Registrierung einer NAAN findest du auf der Webseite *[arks.org](https://arks.org/)* Website.',
    'naan_resource_nma' => 'Name Mapping Authority (NMA)',
    'naan_resource_nma_helpertext' => 'z. B. https://n2t.net/',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Beschriftung',
    'naan_resource_desc_helpertext' => 'Beschriftung für interne Zwecke.',
    'naan_resource_minter' => 'Minter',
    'naan_resource_shoulders' => 'Shoulders',
    'naan_resource_shoulder' => 'Shoulder',
    'naan_resource_dialog_delete_heading' => 'Bist du sicher?',
    'naan_resource_dialog_delete_desc' => 'Es wird nicht mehr möglich sein neue ARKs mit der NAAN zu generieren.',
    'naan_resource_dialog_delete_submit' => 'Ja, ich bin sicher.',

    /*
     * Status Resource
     */
    'status_resource_section' => 'Grundeinstellungen',
    'status_resource_code' => 'Status Code',
    'status_resource_code_help' => 'Codes as defined by RFC 9110',
    'status_resource_message' => 'Nachricht',
    'status_resource_message_help' => 'Nachricht, welche auf der Fehlerseite angezeigt werden soll.',

    /*
     * Import Resource
     */
    'import_resource_navigationlabel' => 'Importations',
    'import_resource_export_list' => 'Export List',
    'import_resource_dialog_delete_heading' => 'Are you sure?',
    'import_resource_dialog_delete_desc' => 'This will delete the Import entries permanently and cannot be undone.',
    'import_resource_dialog_delete_submit' => 'Yes, I\'m sure.',
    'ams.navigation_settings' => 'Settings',


];