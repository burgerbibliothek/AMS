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
    'ark_resource_erc_what_help' => 'Un nome o un altro identificatore orientato all\'utente.',
    'ark_resource_erc_when' => 'Quando',
    'ark_resource_erc_when_help' => 'Una data importante nel ciclo di vita dell\'oggetto.',
    'ark_resource_erc_where' => 'Dove',
    'ark_resource_erc_where_help' => 'Una posizione o un identificatore orientato al sistema.',
    'ark_resource_erc_note' => 'Nota',
    'ark_resource_erc_note_help' => 'Una nota in testo libero sul record.',
    'ark_resource_dialog_delete_heading' => 'Sei sicuro?',
    'ark_resource_dialog_delete_desc' => 'Questa azione eliminerà definitivamente l\'ARK e non può essere annullata.',
    'ark_resource_dialog_delete_submit' => 'Sì, sono sicuro.',
    'ark_resource_actions_import' => 'Importazione CSV',
    'ark_resource_actions_create' => 'Crea ARK',
    'ark_resource_shoulders' => 'Shoulder',
    'ark_resource_import_modalheading' => 'Importazione CSV',
    'ark_resource_import_submitactionlabel' => 'Avvia importazione',
    'ark_resource_import_naan' => 'NAAN',
    'ark_resource_import_naan_helptext' => 'Per le voci senza ARK, il NAAN selezionato viene utilizzato per assegnare nuovi ARK.',
    'ark_resource_import_shoulder' => 'Shoulder',
    'ark_resource_import_shoulder_helptext' => 'Selezione facoltativa di uno shoulder per l\'assegnazione di nuovi ARK.',
    'ark_resource_import_skip' => 'Ignora le voci con URI esistenti.',
    'ark_resource_import_skip_hint' => 'Se questa opzione è selezionata, le voci che dispongono già di un URI identico verranno ignorate.',
    'ark_resource_import_ercwhere' => 'Aggiungi una voce « Dove » con l\'ARK.',
    'ark_resource_import_ercwhere_helptext' => 'Se questa opzione è selezionata, verrà aggiunta una voce « Dove » contenente l\'ARK al record ERC (inclusa la Name Mapping Authority).',
    'ark_resource_revision_title' => 'Revisioni',
    'ark_resource_revision_data' => 'Dati',
    'ark_resource_revision_moddate' => 'Data di revisione',
    'ark_resource_import_mergestrategy' => 'Strategia di fusione dei metadati',
    'ark_resource_import_mergestrategy_helptext' => 'Scegli la strategia da utilizzare durante la fusione dei metadati.',
    'ark_resource_import_mergestrategy_keep' => 'Mantieni: i valori esistenti vengono conservati / i nuovi vengono aggiunti.',
    'ark_resource_import_mergestrategy_overwrite' => 'Sovrascrivi: i campi esistenti / nuovi vengono sovrascritti / aggiunti.',
    'ark_resource_import_mergestrategy_substitute' => 'Sostituisci: il record esistente viene completamente sostituito / eliminato.',

    /*
     * Minter Resource
     */
    'minter_resource_section_minter' => 'Impostazioni del minter',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Nome',
    'minter_resource_name_help' => 'Nome del minter',
    'minter_resource_name_placeholder' => 'es. « alfanumerico senza vocali »',
    'minter_resource_xdigits' => 'Repertorio di caratteri',
    'minter_resource_xdigits_help' => 'I caratteri consentiti sono lettere, numeri o i seguenti caratteri: = ~ * + @ _ $. I caratteri duplicati vengono rimossi al salvataggio. I caratteri vengono memorizzati in ordine.',
    'minter_resource_xdigits_placeholder' => 'es. 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Rilevati caratteri non validi.',
    'minter_resource_xdigits_length_error' => 'Affinché NCDA funzioni, il repertorio di caratteri deve contenere almeno :number caratteri.',
    'minter_resource_length' => 'Lunghezza ID',
    'minter_resource_length_help' => 'Affinché NCDA funzioni, la lunghezza dell\'ID non deve superare il numero di caratteri del repertorio.',
    'minter_resource_lenght_error' => 'Affinché NCDA funzioni, la lunghezza dell\'ID non deve superare :number.',
    'minter_resource_ncda' => 'Aggiungi cifra di controllo',
    'minter_resource_ncda_help' => 'NCDA (Noid Check Digit Algorithm) è un algoritmo utilizzato per calcolare o convalidare una cifra di controllo per un noid (identificatore opaco). Può essere utilizzato per garantire che un ID non contenga errori di trascrizione.',
    'minter_resource_dialog_delete_heading' => 'Sei sicuro?',
    'minter_resource_dialog_delete_desc' => 'Non sarai più in grado di generare nuovi ARK per i NAAN a cui era assegnata questa impostazione.',
    'minter_resource_dialog_delete_submit' => 'Sì, sono sicuro.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Impostazioni di base',
    'naan_resource_naan' => 'Name Assigning Authority Number (NAAN)',
    'naan_resource_naan_helpertext' => 'Per i dettagli su come ottenere un NAAN, consulta il sito web *[arks.org](https://arks.org/about/ark-naans-and-systems/)*',
    'naan_resource_nma' => 'Name Mapping Authority (NMA)',
    'naan_resource_nma_helpertext' => 'es. https://n2t.net/',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Descrizione',
    'naan_resource_desc_helpertext' => 'Nome per uso interno',
    'naan_resource_minter' => 'Minter',
    'naan_resource_shoulders' => 'Shoulders',
    'naan_resource_shoulder' => 'Shoulder',
    'naan_resource_dialog_delete_heading' => 'Sei sicuro?',
    'naan_resource_dialog_delete_desc' => 'Non sarai più in grado di generare nuovi ARK per questo NAAN.',
    'naan_resource_dialog_delete_submit' => 'Sì, sono sicuro.',
    'naan_resource_spt' => 'Suffix Passthrough',
    'naan_resource_spt_help' => 'Se questa opzione è attivata, il suffisso viene aggiunto alla fine dell\'URL di localizzazione (URL di destinazione) dell\'identificatore.',

    /*
     * Status Resource
     */
    'status_resource_section' => 'Impostazioni di base',
    'status_resource_code' => 'Codice di stato',
    'status_resource_code_help' => 'Codici come definiti nella RFC 9110. Sono accettati i seguenti codici: 400, 403, 410, 451.',
    'status_resource_message' => 'Messaggio',
    'status_resource_message_help' => 'Messaggio visualizzato nella pagina di errore.',

    /*
     * Import Resource
     */
    'import_resource_navigationlabel' => 'Operazioni di importazione',
    'import_resource_export_list' => 'Esporta elenco',
    'import_resource_dialog_delete_heading' => 'Sei sicuro?',
    'import_resource_dialog_delete_desc' => 'Questa azione eliminerà definitivamente le voci di importazione e non può essere annullata.',
    'import_resource_dialog_delete_submit' => 'Sì, sono sicuro.',
    'import_resource_successfull_title' => 'Operazioni riuscite',
    'import_resource_unsuccessfull_title' => 'Operazioni non riuscite',
    'import_resource_unsuccessfull_table_data' => 'Record',
    'import_resource_unsuccessfull_table_error' => 'Messaggio di errore',
    'import_resource_unsuccessfull_table_created_at' => 'Creato il',
    'import_resource_details_total_rows' => 'Totale operazioni',
    'import_resource_details_successfull_rows' => 'Operazioni riuscite',
    'import_resource_details_created_at' => 'Avviato il',
    'import_resource_details_completed_at' => 'Completato il',
    'ams.navigation_settings' => 'Impostazioni',

];
