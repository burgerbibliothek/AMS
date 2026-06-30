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
    'button_new' => 'Créer  :thing',

    /*
     * ARK Resource
     */
    'ark_resource_section_basic' => 'Paramètres de base',
    'ark_resource_ark' => 'Clé de ressource d\'archivage (ARK)',
    'ark_resource_ark_list' => 'ARK',
    'ark_resource_naan' => 'NAAN',
    'ark_resource_uri' => 'Identifiant uniforme de ressource (URI)',
    'ark_resource_uri_list' => 'URI',
    'ark_resource_status' => 'Statut HTTP',
    'ark_resource_section_metadata' => 'Métadonnées',
    'ark_resource_erc_who' => 'Qui',
    'ark_resource_erc_who_help' => 'Une personne ou une entité responsable.',
    'ark_resource_erc_what' => 'Quoi',
    'ark_resource_erc_what_help' => 'Un nom ou tout autre identifiant destiné à l\'être humain.',
    'ark_resource_erc_when' => 'Quand',
    'ark_resource_erc_when_help' => 'Une date importante dans le cycle de vie de l\'objet.',
    'ark_resource_erc_where' => 'Où',
    'ark_resource_erc_where_help' => 'Un emplacement ou un identifiant lié au système.',
    'ark_resource_erc_note' => 'Remarque',
    'ark_resource_erc_note_help' => 'Une remarque sous forme de texte libre concernant l\'enregistrement.',
    'ark_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'ark_resource_dialog_delete_desc' => 'Cette action supprimera définitivement l\'ARK et ne pourra pas être annulée.',
    'ark_resource_dialog_delete_submit' => 'Oui, je suis sûr.',
    'ark_resource_actions_import' => 'Importation CSV',
    'ark_resource_actions_create' => 'Créer un ARK',
    'ark_resource_shoulders' => 'Épaule',
    'ark_resource_import_modalheading' => 'Importation CSV',
    'ark_resource_import_submitactionlabel' => 'Lancer l\'importation',
    'ark_resource_import_naan' => 'NAAN',

    /*
     * Ressource « Minter »
     */
    'minter_resource_section_minter' => 'Paramètres du créateur',
    'minter_resource_section_minter_desc' => '',
    'minter_resource_name' => 'Nom',
    'minter_resource_name_help' => 'Étiquetage du Minter',
    'minter_resource_name_placeholder' => 'Par exemple : « alphanumérique sans voyelles »',
    'minter_resource_xdigits' => 'Jeu de caractères',
    'minter_resource_xdigits_help' => 'Les caractères autorisés sont les lettres, les chiffres ou les caractères suivants : = ~ * + @ _ $. Les caractères en double sont supprimés lors de l\'enregistrement. Les caractères sont enregistrés triés.',
    'minter_resource_xdigits_placeholder' => 'Par exemple : 0123456789bcdfghjkmnpqrstvwxz',
    'minter_resource_xdigits_error' => 'Caractères non valides détectés.',
    'minter_resource_xdigits_length_error' => 'Pour que le NCDA fonctionne, le jeu de caractères doit comporter au moins :number caractères.',
    'minter_resource_length' => 'Longueur de l\'identifiant',
    'minter_resource_length_help' => 'La longueur de l\'identifiant ne doit pas dépasser le nombre de caractères du jeu de caractères pour que le NCDA fonctionne.',
    'minter_resource_lenght_error' => 'Pour que le NCDA fonctionne, la longueur de l\'identifiant ne doit pas dépasser :number',
    'minter_resource_ncda' => 'Ajouter un caractère de contrôle',
    'minter_resource_ncda_help' => 'Le NCDA (Noid Check Digit Algorithm) est un algorithme utilisé pour calculer ou valider un caractère de somme de contrôle noid (nice opaque identifier). Il permet de s\'assurer qu\'un identifiant ne contient pas d\'erreur de transcription.',
    'minter_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'minter_resource_dialog_delete_desc' => 'Vous ne pourrez plus générer de nouveaux ARK pour les NAAN auxquels ce paramètre a été associé.',
    'minter_resource_dialog_delete_submit' => 'Oui, je suis sûr.',

    /*
     * NAAN Resource
     */
    'naan_resource_section_minter' => 'Paramètres de base',
    'naan_resource_naan' => 'Name Assigning Authority Number (NAAN)',
    'naan_resource_naan_helpertext' => 'Vous trouverez des informations détaillées sur la manière d’obtenir un NAAN sur le site *[arks.org](https://arks.org/about/ark-naans-and-systems/)*',
    'naan_resource_nma' => 'Name Mapping Authority (NMA)',
    'naan_resource_nma_helpertext' => 'par exemple : https://n2t.net/',
    'naan_resource_naan_list' => 'NAAN',
    'naan_resource_desc' => 'Description',
    'naan_resource_desc_helpertext' => 'Libellé à usage interne',
    'naan_resource_minter' => 'Émetteur',
    'naan_resource_shoulders' => 'Shoulders',
    'naan_resource_shoulder' => 'Shoulder',
    'naan_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'naan_resource_dialog_delete_desc' => 'Vous ne pourrez plus générer de nouveaux ARK pour ce NAAN.',
    'naan_resource_dialog_delete_submit' => 'Oui, je suis sûr.',
    'naan_resource_spt' => 'Suffix Passthrough',
    'naan_resource_spt_help' => 'Lorsqu\'il est activé, le suffixe est ajouté à la fin de l\'URL de localisation (cible) de l\'identifiant.',

    /*
     * Ressource d'état
     */
    'status_resource_section' => 'Paramètres de base',
    'status_resource_code' => 'Code d\'état',
    'status_resource_code_help' => 'Codes définis par la norme RFC 9110',
    'status_resource_message' => 'Message',
    'status_resource_message_help' => 'Message qui s\'affichera sur la page d\'erreur.',

    /*
     * Ressource d’importation
     */
    'import_resource_navigationlabel' => 'Importations',
    'import_resource_export_list' => 'Liste d’exportation',
    'import_resource_dialog_delete_heading' => 'Êtes-vous sûr ?',
    'import_resource_dialog_delete_desc' => 'Cette action supprimera définitivement les entrées d’importation et ne pourra pas être annulée.',
    'import_resource_dialog_delete_submit' => 'Oui, je suis sûr.',
    'ams.navigation_settings' => 'Paramètres',

];