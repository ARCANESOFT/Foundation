<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'file_path'   => 'Chemin du fichier',
        'log_entries' => 'Enregistrements',
        'size'        => 'Taille',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'dashboard'     => 'Tableau de bord',
        'logs-list'     => 'Liste des journaux',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'entries-stats' => ':count enregistrements - :percent %',
    'no-entries'    => "Il n'y a aucun enregistrements pour le moment.",

    'messages'      => [
        'deleted' => [
            'title'   => 'Journal supprimé !',
            'message' => 'Journal [:date] a été supprimé avec succès !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Supprimer journal',
            'message' => 'Êtes-vous sûr de vouloir <span class="label label-danger">supprimer</span> ce journal: <span class="label label-primary">:date</span> ?'
        ],
    ],

];
