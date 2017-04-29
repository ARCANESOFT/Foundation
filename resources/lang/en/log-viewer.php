<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'file_path'   => 'File path',
        'log_entries' => 'Log entries',
        'size'        => 'Size',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'dashboard'     => 'Dashboard',
        'logs-list'     => 'Logs list',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'entries-stats' => ':count entries - :percent %',
    'no-entries'    => 'There is no log for the time being.',

    'messages' => [
        'deleted' => [
            'title'   => 'Log Deleted !',
            'message' => 'Log [:date] was deleted successfully !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Delete Log',
            'message' => 'Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">:date</span> ?'
        ],
    ],

];
