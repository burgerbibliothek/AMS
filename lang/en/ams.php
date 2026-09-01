<?php

return [

    /**
     * Navigation
     */
    'navigation_settings' => 'Settings',

    /*
     * Actions
     */
    'button_delete' => 'Delete',
    'button_new' => 'Create :thing',

    /*
     * ARK Resource
     */
    'ark_resource_section_basic' => 'Basic settings',
    'ark_resource_ark' => 'Archival Resource Key (ARK)',
    'ark_resource_ark_list' => 'ARK',
    'ark_resource_naan' => 'NAAN',
    'ark_resource_uri' => 'Uniform Resource Identifier (URI)',
    'ark_resource_uri_list' => 'URI',
    'ark_resource_status' => 'HTTP status',
    'ark_resource_section_metadata' => 'Metadata',
    'ark_resource_erc_who' => 'Who',
    'ark_resource_erc_who_help' => 'A responsible person or party.',
    'ark_resource_erc_what' => 'What',
    'ark_resource_erc_what_help' => 'A name or other user-oriented identifier.',
    'ark_resource_erc_when' => 'When',
    'ark_resource_erc_when_help' => 'An important date in the object\'s life cycle.',
    'ark_resource_erc_where' => 'Where',
    'ark_resource_erc_where_help' => 'A location or a system-oriented identifier.',
    'ark_resource_erc_note' => 'Note',
    'ark_resource_erc_note_help' => 'A free-text note about the record.',
    'ark_resource_dialog_delete_heading' => 'Are you sure?',
    'ark_resource_dialog_delete_desc' => 'This will permanently delete the ARK and cannot be undone.',
    'ark_resource_dialog_delete_submit' => 'Yes, I am sure.',
    'ark_resource_actions_import' => 'CSV import',
    'ark_resource_actions_create' => 'Create ARK',
    'ark_resource_shoulders' => 'Shoulder',
    'ark_resource_import_modalheading' => 'CSV import',
    'ark_resource_import_submitactionlabel' => 'Start import',
    'ark_resource_import_naan' => 'NAAN',
    'ark_resource_import_naan_helptext' => 'For entries without an ARK, the selected NAAN is used to assign new ARKs.',
    'ark_resource_import_shoulder' => 'Shoulder',
    'ark_resource_import_shoulder_helptext' => 'Optional selection of a shoulder for assigning new ARKs.',
    'ark_resource_import_skip' => 'Skip entries with existing URIs.',
    'ark_resource_import_skip_hint' => 'If this option is selected, entries that already have an identical URI will be skipped.',
    'ark_resource_import_ercwhere' => 'Add a "Where" story with the ARK.',
    'ark_resource_import_ercwhere_helptext' => 'If this option is selected, a "Where" story containing the ARK will be added to the ERC record (including Name Mapping Authority).',
    'ark_resource_revision_title' => 'Revisions',
    'ark_resource_revision_data' => 'Data',
    'ark_resource_revision_moddate' => 'Revision date',
    'ark_resource_import_mergestrategy' => 'Metadata merge strategy',
    'ark_resource_import_mergestrategy_helptext' => 'Choose the strategy to be used when merging metadata.',
    'ark_resource_import_mergestrategy_keep' => 'Keep: Existing values are retained / new ones are added.',
    'ark_resource_import_mergestrategy_overwrite' => 'Overwrite: Existing / new fields are overwritten / added.',
    'ark_resource_import_mergestrategy_substitute' => 'Substitute: The existing record is completely replaced / deleted.',

    /*
     * Minter Resource
     */
    'minter_resource_section_minter' => 'Minter settings',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Name',
    'minter_resource_name_help' => 'Name of the minter',
    'minter_resource_name_placeholder' => 'e.g. "alphanumeric without vowels"',
    'minter_resource_xdigits' => 'Character repertoire',
    'minter_resource_xdigits_help' => 'Allowed characters are letters, numbers or the following characters: = ~ * + @ _ $. Duplicate characters are removed when saving. The characters are stored sorted.',
    'minter_resource_xdigits_placeholder' => 'e.g. 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Invalid characters detected.',
    'minter_resource_xdigits_length_error' => 'For NCDA to work, the character repertoire must contain at least :number characters.',
    'minter_resource_length' => 'ID length',
    'minter_resource_length_help' => 'The ID length should not exceed the number of characters in the character repertoire for NCDA to work.',
    'minter_resource_lenght_error' => 'For NCDA to work, the ID length must not exceed :number.',
    'minter_resource_ncda' => 'Add check digit',
    'minter_resource_ncda_help' => 'NCDA (Noid Check Digit Algorithm) is an algorithm used to calculate or validate a check digit for a noid (nice opaque identifier). It can be used to ensure that an ID contains no transcription errors.',
    'minter_resource_dialog_delete_heading' => 'Are you sure?',
    'minter_resource_dialog_delete_desc' => 'You will no longer be able to generate new ARKs for NAANs to which this setting was assigned.',
    'minter_resource_dialog_delete_submit' => 'Yes, I am sure.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Basic settings',
    'naan_resource_naan' => 'Name Assigning Authority Number (NAAN)',
    'naan_resource_naan_helpertext' => 'For details on obtaining a NAAN, see the website *[arks.org](https://arks.org/about/ark-naans-and-systems/)*',
    'naan_resource_nma' => 'Name Mapping Authority (NMA)',
    'naan_resource_nma_helpertext' => 'e.g. https://n2t.net/',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Description',
    'naan_resource_desc_helpertext' => 'Name for internal purposes',
    'naan_resource_minter' => 'Minter',
    'naan_resource_shoulders' => 'Shoulders',
    'naan_resource_shoulder' => 'Shoulder',
    'naan_resource_dialog_delete_heading' => 'Are you sure?',
    'naan_resource_dialog_delete_desc' => 'You will no longer be able to generate new ARKs for this NAAN.',
    'naan_resource_dialog_delete_submit' => 'Yes, I am sure.',
    'naan_resource_spt' => 'Suffix Passthrough',
    'naan_resource_spt_help' => 'If this option is enabled, the suffix is appended to the end of the identifier\'s location URL (target URL).',

    /*
     * Status Resource
     */
    'status_resource_section' => 'Basic settings',
    'status_resource_code' => 'Status code',
    'status_resource_code_help' => 'Codes as defined in RFC 9110. The following codes are accepted: 400, 403, 410, 451.',
    'status_resource_message' => 'Message',
    'status_resource_message_help' => 'Message displayed on the error page.',

    /*
     * Import Resource
     */
    'import_resource_navigationlabel' => 'Import operations',
    'import_resource_export_list' => 'Export list',
    'import_resource_dialog_delete_heading' => 'Are you sure?',
    'import_resource_dialog_delete_desc' => 'This will permanently delete the import entries and cannot be undone.',
    'import_resource_dialog_delete_submit' => 'Yes, I am sure.',
    'import_resource_successfull_title' => 'Successful processes',
    'import_resource_unsuccessfull_title' => 'Failed processes',
    'import_resource_unsuccessfull_table_data' => 'Record',
    'import_resource_unsuccessfull_table_error' => 'Error message',
    'import_resource_unsuccessfull_table_created_at' => 'Created at',
    'import_resource_details_total_rows' => 'Total processes',
    'import_resource_details_successfull_rows' => 'Successful processes',
    'import_resource_details_created_at' => 'Started at',
    'import_resource_details_completed_at' => 'Completed at',
    'ams.navigation_settings' => 'Settings',

];
