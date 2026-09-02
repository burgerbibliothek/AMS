<?php

return [

    /**
     * Navigation
     */
    'navigation_settings' => 'Paramètres',

    /*
     * Actions
     */
    'button_delete' => 'Supprimer',
    'button_new' => 'Créer :thing',

    /*
     * ARK Resource
     */
    'ark_resource_section_basic' => 'Paramètres de base',
    'ark_resource_ark' => 'Archival Resource Key (ARK)',
    'ark_resource_ark_list' => 'ARK',
    'ark_resource_naan' => 'NAAN',
    'ark_resource_uri' => 'Uniform Resource Identifier (URI)',
    'ark_resource_uri_list' => 'URI',
    'ark_resource_status' => 'Statut HTTP',
    'ark_resource_section_metadata' => 'Métadonnées',
    'ark_resource_erc_who' => 'Qui',
    'ark_resource_erc_who_help' => 'Une personne ou une entité responsable.',
    'ark_resource_erc_what' => 'Quoi',
    'ark_resource_erc_what_help' => 'Un nom ou un autre identifiant orienté utilisateur.',
    'ark_resource_erc_when' => 'Quand',
    'ark_resource_erc_when_help' => 'Une date importante dans le cycle de vie de l\'objet.',
    'ark_resource_erc_where' => 'Où',
    'ark_resource_erc_where_help' => 'Un lieu ou un identifiant orienté système.',
    'ark_resource_erc_note' => 'Note',
    'ark_resource_erc_note_help' => 'Une note en texte libre concernant l\'enregistrement.',
    'ark_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'ark_resource_dialog_delete_desc' => 'Cette action supprimera définitivement l\'ARK et est irréversible.',
    'ark_resource_dialog_delete_submit' => 'Oui, je suis sûr.',
    'ark_resource_actions_import' => 'Import CSV',
    'ark_resource_actions_create' => 'Créer un ARK',
    'ark_resource_shoulders' => 'Shoulder',
    'ark_resource_import_modalheading' => 'Import CSV',
    'ark_resource_import_submitactionlabel' => 'Lancer l\'import',
    'ark_resource_import_naan' => 'NAAN',
    'ark_resource_import_naan_helptext' => 'Pour les entrées sans ARK, le NAAN sélectionné est utilisé pour attribuer de nouveaux ARK.',
    'ark_resource_import_shoulder' => 'Shoulder',
    'ark_resource_import_shoulder_helptext' => 'Sélection facultative d\'un shoulder pour l\'attribution de nouveaux ARK.',
    'ark_resource_import_skip' => 'Ignorer les entrées avec des URI existantes.',
    'ark_resource_import_skip_hint' => 'Si cette option est sélectionnée, les entrées disposant déjà d\'une URI identique seront ignorées.',
    'ark_resource_import_ercwhere' => 'Ajouter une entrée « Où » avec l\'ARK.',
    'ark_resource_import_ercwhere_helptext' => 'Si cette option est sélectionnée, une entrée « where » contenant l\'ARK sera ajoutée à l\'enregistrement ERC (y compris Name Mapping Authority).',
    'ark_resource_revision_title' => 'Révisions',
    'ark_resource_revision_data' => 'Données',
    'ark_resource_revision_moddate' => 'Date de révision',
    'ark_resource_import_mergestrategy' => 'Stratégie de fusion des métadonnées',
    'ark_resource_import_mergestrategy_helptext' => 'Choisissez la stratégie à utiliser lors de la fusion des métadonnées.',
    'ark_resource_import_mergestrategy_keep' => 'Conserver : les valeurs existantes sont conservées / les nouvelles sont ajoutées.',
    'ark_resource_import_mergestrategy_overwrite' => 'Écraser : les champs existants / nouveaux sont écrasés / ajoutés.',
    'ark_resource_import_mergestrategy_substitute' => 'Substituer : l\'enregistrement existant est entièrement remplacé / supprimé.',

    /*
     * Minter Resource
     */
    'minter_resource_section_minter' => 'Paramètres du minter',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Nom',
    'minter_resource_name_help' => 'Nom du minter',
    'minter_resource_name_placeholder' => 'p. ex. « alphanumérique sans voyelles »',
    'minter_resource_xdigits' => 'Répertoire de caractères',
    'minter_resource_xdigits_help' => 'Les caractères autorisés sont des lettres, des chiffres ou les caractères suivants : = ~ * + @ _ $. Les caractères en double sont supprimés lors de l\'enregistrement. Les caractères sont stockés triés.',
    'minter_resource_xdigits_placeholder' => 'p. ex. 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Caractères invalides détectés.',
    'minter_resource_xdigits_length_error' => 'Pour que NCDA fonctionne, le répertoire de caractères doit contenir au moins :number caractères.',
    'minter_resource_length' => 'Longueur de l\'identifiant',
    'minter_resource_length_help' => 'Pour que NCDA fonctionne, la longueur de l\'identifiant ne doit pas dépasser le nombre de caractères du répertoire.',
    'minter_resource_lenght_error' => 'Pour que NCDA fonctionne, la longueur de l\'identifiant ne doit pas dépasser :number.',
    'minter_resource_ncda' => 'Ajouter un chiffre de contrôle',
    'minter_resource_ncda_help' => 'NCDA (Noid Check Digit Algorithm) est un algorithme utilisé pour calculer ou valider un chiffre de contrôle pour un noid (identifiant opaque). Il peut être utilisé pour garantir qu\'un identifiant ne contient pas d\'erreur de transcription.',
    'minter_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'minter_resource_dialog_delete_desc' => 'Vous ne pourrez plus générer de nouveaux ARK pour les NAAN auxquels ce paramètre était attribué.',
    'minter_resource_dialog_delete_submit' => 'Oui, je suis sûr.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Paramètres de base',
    'naan_resource_naan' => 'Numéro d\'autorité d\'attribution de noms (NAAN)',
    'naan_resource_naan_helpertext' => 'Pour plus de détails sur l\'obtention d\'un NAAN, consultez le site web *[arks.org](https://arks.org/about/ark-naans-and-systems/)*',
    'naan_resource_nma' => 'Autorité de mappage des noms (NMA)',
    'naan_resource_nma_helpertext' => 'p. ex. https://n2t.net/',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Description',
    'naan_resource_desc_helpertext' => 'Nom à des fins internes',
    'naan_resource_minter' => 'Minter',
    'naan_resource_shoulders' => 'Shoulders',
    'naan_resource_shoulder' => 'Shoulder',
    'naan_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'naan_resource_dialog_delete_desc' => 'Vous ne pourrez plus générer de nouveaux ARK pour ce NAAN.',
    'naan_resource_dialog_delete_submit' => 'Oui, je suis sûr.',
    'naan_resource_spt' => 'Suffixe de transmission (Suffix Passthrough)',
    'naan_resource_spt_help' => 'Si cette option est activée, le suffixe est ajouté à la fin de l\'URL de localisation (URL cible) de l\'identifiant.',

    /*
     * Status Resource
     */
    'status_resource_section' => 'Paramètres de base',
    'status_resource_code' => 'Code de statut',
    'status_resource_code_help' => 'Codes définis dans la RFC 9110. Les codes suivants sont acceptés : 400, 410, 451.',
    'status_resource_message' => 'Message',
    'status_resource_message_help' => 'Message affiché sur la page d\'erreur.',

    /*
     * Import Resource
     */
    'import_resource_navigationlabel' => 'Opérations d\'import',
    'import_resource_export_list' => 'Exporter la liste',
    'import_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'import_resource_dialog_delete_desc' => 'Cette action supprimera définitivement les entrées d\'import et est irréversible.',
    'import_resource_dialog_delete_submit' => 'Oui, je suis sûr.',
    'import_resource_successfull_title' => 'Opérations réussies',
    'import_resource_unsuccessfull_title' => 'Opérations échouées',
    'import_resource_unsuccessfull_table_data' => 'Enregistrement',
    'import_resource_unsuccessfull_table_error' => 'Message d\'erreur',
    'import_resource_unsuccessfull_table_created_at' => 'Créé le',
    'import_resource_details_total_rows' => 'Nombre total d\'opérations',
    'import_resource_details_successfull_rows' => 'Opérations réussies',
    'import_resource_details_created_at' => 'Démarré le',
    'import_resource_details_completed_at' => 'Terminé le',
    'ams.navigation_settings' => 'Paramètres',

];
