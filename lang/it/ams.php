<?php

return [

    /**
     * Navigation
     */
    'navigation_settings' => 'Impostazioni',

    /*
     * Actions
     */
    'button_delete' => 'Elimina',
    'button_new' => 'Crea :thing',

    /*
     * ARK Resource
     */
    'ark_resource_section_basic' => 'Impostazioni di base',
    'ark_resource_ark' => 'Archival Resource Key (ARK)',
    'ark_resource_ark_list' => 'ARK',
    'ark_resource_naan' => 'NAAN',
    'ark_resource_uri' => 'Uniform Resource Identifier (URI)',
    'ark_resource_uri_list' => 'URI',
    'ark_resource_status' => 'Stato HTTP',
    'ark_resource_section_metadata' => 'Metadati',
    'ark_resource_erc_who' => 'Chi',
    'ark_resource_erc_who_help' => 'Una persona o un\'entità responsabile.',
    'ark_resource_erc_what' => 'Cosa',
    'ark_resource_erc_what_help' => 'Un nome o altro identificatore orientato all\'utente.',
    'ark_resource_erc_when' => 'Quando',
    'ark_resource_erc_when_help' => 'Una data importante nel ciclo di vita dell\'oggetto.',
    'ark_resource_erc_where' => 'Dove',
    'ark_resource_erc_where_help' => 'Una posizione o un identificatore orientato al sistema.',
    'ark_resource_erc_note' => 'Nota',
    'ark_resource_erc_note_help' => 'Una nota di testo libero relativa al record.',
    'ark_resource_dialog_delete_heading' => 'Sei sicuro?',
    'ark_resource_dialog_delete_desc' => 'Questo eliminerà definitivamente l\'ARK e non potrà essere annullato.',
    'ark_resource_dialog_delete_submit' => 'Sì, sono sicuro.',
    'ark_resource_actions_import' => 'Importazione CSV',
    'ark_resource_actions_create' => 'Crea ARK',
    'ark_resource_shoulders' => 'Spalla',
    'ark_resource_import_modalheading' => 'Importazione CSV',
    'ark_resource_import_submitactionlabel' => 'Avvia importazione',
    'ark_resource_import_naan' => 'NAAN',
    'ark_resource_import_naan_helptext' => 'Per le voci senza ARK, il NAAN selezionato viene utilizzato per assegnare nuovi ARK.',
    'ark_resource_import_shoulder' => 'Spalla',
    'ark_resource_import_shoulder_helptext' => 'Selezione facoltativa di una spalla per l\'assegnazione di nuovi ARK.',
    'ark_resource_import_skip' => 'Salta le voci con URI esistenti.',
    'ark_resource_import_skip_hint' => 'Se questa opzione è selezionata, le voci che hanno già un URI identico vengono saltate.',
    'ark_resource_import_ercwhere' => 'Aggiungi la storia "where" con l\'ARK.',
    'ark_resource_import_ercwhere_helptext' => 'Se questa opzione è selezionata, una storia "where" contenente l\'ARK viene aggiunta al record ERC (incl. Name Mapping Authority).',
    'ark_resource_revision_title' => 'Revisioni',
    'ark_resource_revision_data' => 'Dati',
    'ark_resource_revision_moddate' => 'Data di revisione',

    /*
     * Minter Resource
     */
    'minter_resource_section_minter' => 'Impostazioni del minter',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Nome',
    'minter_resource_name_help' => 'Etichettatura del minter',
    'minter_resource_name_placeholder' => 'Es. "alfanumerico senza vocali"',
    'minter_resource_xdigits' => 'Repertorio di caratteri',
    'minter_resource_xdigits_help' => 'I caratteri consentiti sono lettere, numeri o i seguenti caratteri: = ~ * + @ _ $. I caratteri duplicati vengono rimossi al salvataggio. I caratteri vengono salvati ordinati.',
    'minter_resource_xdigits_placeholder' => 'Es. 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Rilevati caratteri non validi.',
    'minter_resource_xdigits_length_error' => 'Affinché l\'NCDA funzioni, il repertorio di caratteri deve avere almeno :number caratteri.',
    'minter_resource_length' => 'Lunghezza ID',
    'minter_resource_length_help' => 'La lunghezza dell\'ID non dovrebbe superare il numero di caratteri nel repertorio di caratteri affinché l\'NCDA funzioni.',
    'minter_resource_lenght_error' => 'Affinché l\'NCDA funzioni, la lunghezza dell\'ID non deve superare :number',
    'minter_resource_ncda' => 'Aggiungi carattere di checksum',
    'minter_resource_ncda_help' => 'NCDA (Noid Check Digit Algorithm) è un algoritmo utilizzato per calcolare o convalidare un carattere di checksum noid (nice opaque identifier). Può essere utilizzato per verificare che un ID non contenga errori di trascrizione.',
    'minter_resource_dialog_delete_heading' => 'Sei sicuro?',
    'minter_resource_dialog_delete_desc' => 'Non sarà possibile generare nuovi ARK per i NAAN a cui era associata questa impostazione.',
    'minter_resource_dialog_delete_submit' => 'Sì, sono sicuro.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Impostazioni di base',
    'naan_resource_naan' => 'Name Assigning Authority Number (NAAN)',
    'naan_resource_naan_helpertext' => 'I dettagli su come ottenere un NAAN si trovano sul sito *[arks.org](https://arks.org/about/ark-naans-and-systems/)*',
    'naan_resource_nma' => 'Name Mapping Authority (NMA)',
    'naan_resource_nma_helpertext' => 'es. https://n2t.net/',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Descrizione',
    'naan_resource_desc_helpertext' => 'Etichetta per scopi interni',
    'naan_resource_minter' => 'Minter',
    'naan_resource_shoulders' => 'Spalle',
    'naan_resource_shoulder' => 'Spalla',
    'naan_resource_dialog_delete_heading' => 'Sei sicuro?',
    'naan_resource_dialog_delete_desc' => 'Non sarà possibile generare nuovi ARK per questo NAAN.',
    'naan_resource_dialog_delete_submit' => 'Sì, sono sicuro.',
    'naan_resource_spt' => 'Suffix Passthrough',
    'naan_resource_spt_help' => 'Una volta attivato, il suffisso viene aggiunto alla fine dell\'URL di destinazione dell\'identificatore.',

    /*
     * Status Resource
     */
    'status_resource_section' => 'Impostazioni di base',
    'status_resource_code' => 'Codice di stato',
    'status_resource_code_help' => 'Codici come definiti dalla RFC 9110',
    'status_resource_message' => 'Messaggio',
    'status_resource_message_help' => 'Messaggio che verrà visualizzato nella pagina di errore.',

    /*
     * Import Resource
     */
    'import_resource_navigationlabel' => 'Importazioni',
    'import_resource_export_list' => 'Esporta elenco',
    'import_resource_dialog_delete_heading' => 'Sei sicuro?',
    'import_resource_dialog_delete_desc' => 'Questo eliminerà definitivamente le voci di importazione e non potrà essere annullato.',
    'import_resource_dialog_delete_submit' => 'Sì, sono sicuro.',
    'ams.navigation_settings' => 'Impostazioni',


];
