<?php

return [

    /*
     * Actions
     */
    'button_delete' => 'Delete',
    'button_new' => 'Create :thing',

    /*
     * ARK Resource
     */
    'ark_resource_section_basic' => 'Basic Settings',
    'ark_resource_ark' => 'Archival Resource Key (ARK)',
    'ark_resource_ark_list' => 'ARK',
    'ark_resource_naan' => 'NAAN',
    'ark_resource_uri' => 'Uniform Resource Identifier (URI)',
    'ark_resource_uri_list' => 'URI',
    'ark_resource_status' => 'HTTP-Status',
    'ark_resource_section_metadata' => 'Electronic Resource Citation (ERC)',
    'ark_resource_erc_who' => 'Who',
    'ark_resource_erc_who_help' => 'A responsible person or party.',
    'ark_resource_erc_what' => 'What',
    'ark_resource_erc_what_help' => 'A name or other human-oriented identifier.',
    'ark_resource_erc_when' => 'When',
    'ark_resource_erc_when_help' => 'A date important in the object\'s lifecycle.',
    'ark_resource_erc_where' => 'Where',
    'ark_resource_erc_where_help' => 'A location or system-oriented identifier.',
    'ark_resource_erc_note' => 'Note',
    'ark_resource_erc_note_help' => 'A location or system-oriented identifier.',
    'ark_resource_dialog_delete_heading' => 'Are you sure?',
    'ark_resource_dialog_delete_desc' => 'This will delete the ARK permanently and cannot be undone.',
    'ark_resource_dialog_delete_submit' => 'Yes, I\'m sure.',
    'ark_resource_actions_import' => 'CSV-Import',
    'ark_resource_actions_create' => 'Create ARK',
    'ark_resource_shoulders' => 'Shoulder',

    /*
     * Minter Resource
     */
    'minter_resource_section_minter' => 'Minter Settings',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Name',
    'minter_resource_name_help' => 'Labeling of the minter',
    'minter_resource_name_placeholder' => 'E. g. “alphanumeric w/o vowels”',
    'minter_resource_xdigits' => 'Character Repetoire',
    'minter_resource_xdigits_help' => 'Allowed characters are letters, numbers or the following characters: = ~ * + @ _ $. Duplicate characters are removed upon saving. The characters are saved sorted.',
    'minter_resource_xdigits_placeholder' => 'E. g. 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Detected invalid characters.',
    'minter_resource_length' => 'ID-Length',
    'minter_resource_length_help' => 'The ID length should not exceed the number of characters in the character repetoire for the NCDA to work.',
    'minter_resource_lenght_error' => 'In order for the NCDA to work the ID-length must not exceed :number',
    'minter_resource_ncda' => 'Add Checksum Char',
    'minter_resource_ncda_help' => 'NCDA (Noid Check Digit Algorithm) is an algorithm used to compute or validate a noid (nice opaque identifier) checksum char. It can be used to assert that an ID doesn\'t contains transcription error. ',
    'minter_resource_dialog_delete_heading' => 'Are you sure?',
    'minter_resource_dialog_delete_desc' => 'You won\'t be able to generate new ARKs for NAANs which have had this setting associated.',
    'minter_resource_dialog_delete_submit' => 'Yes, I\'m sure.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Basic Settings',
    'naan_resource_naan' => 'Name Assigning Authority Number (NAAN)',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Description',
    'naan_resource_minter' => 'Minter',
    'naan_resource_shoulders' => 'Shoulders',
    'naan_resource_shoulder' => 'Shoulder',
    'naan_resource_dialog_delete_heading' => 'Are you sure?',
    'naan_resource_dialog_delete_desc' => 'You won\'t be able to generate new ARKs for this NAAN.',
    'naan_resource_dialog_delete_submit' => 'Yes, I\'m sure.',

    /*
     * Status Resource
     */
    'status_resource_section' => 'Basic Settings',
    'status_resource_code' => 'Status Code',
    'status_resource_code_help' => 'Codes as defined by RFC 9110',
    'status_resource_message' => 'Message',
    'status_resource_message_help' => 'Message which will be displayed on error page.',
    
    /*
     * Import Resource
     */
    'import_resource_navigationlabel' => 'Importations'

];
