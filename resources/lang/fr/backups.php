<?php

return [
    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'name'              => 'Nom',
        'disk'              => 'Disque',
        'reachable'         => 'Accessible',
        'healthy'           => 'Sain',
        'number_of_backups' => 'Nbr de sauvegardes',
        'newest_backup'     => 'La plus récente sauvegarde',
        'used_storage'      => 'Stockage utilisé',

        'date'              => 'Date',
        'path'              => 'Chemin',
        'size'              => 'Taille',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'backups'               => 'Sauvegardes',
        'monitor-status'        => 'Statut du moniteur',
        'monitor-statuses-list' => 'Liste des statuts du moniteur',
    ],

    /* -----------------------------------------------------------------
     |  Actions
     | -----------------------------------------------------------------
     */

    'actions' => [
        'run-backups'   => 'Exécuter les sauvegardes',
        'clear-backups' => 'Nettoyer les sauvegardes',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'messages' => [
        'created' => [
            'title'   => 'Backups created !',
            'message' => 'The Backups was created successfully !',
        ],

        'cleared' => [
            'title'   => 'Backups cleared !',
            'message' => 'The Backups was cleared successfully !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'backup' => [
            'title'   => 'Sauvegarder tout',
            'message' => 'Êtes-vous sûr de vouloir exécuter la <span class="label label-success">sauvegarde</span> des base de données ?',
        ],

        'clear' => [
            'title'   => 'Effacer toutes les sauvegardes',
            'message' => 'Êtes-vous sûr de vouloir <span class="label label-warning">nettoyer</span> toutes les anciennes sauvegardes ?',
        ],
    ],

];
