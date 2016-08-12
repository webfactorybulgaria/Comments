<?php

return [
    'per_page' => 30,
    'order' => [
        'id' => 'desc',
    ],
    'sidebar' => [
        'icon' => 'icon fa fa-fw fa-comments',
        'weight' => 6,
    ],
    'source' => 'local',
    'sources' => [
        'local' => [
            /*
            |--------------------------------------------------------------------------
            | Allowing guests to comment
            |--------------------------------------------------------------------------
            |
            | If set to true users who are not logged in can comment.
            | The guest comments always pend moderation
            |
            */
            'guests_allowed' => false,

            /*
            |--------------------------------------------------------------------------
            | Comments pend approval
            |--------------------------------------------------------------------------
            |
            | If set to true all comments will be in status pending untill approved
            | This doesn't apply to super user comments
            |
            */
            'must_approve' => false,

            'repository' => '\TypiCMS\Modules\Comments\Repositories\EloquentComment',
        ],
        'disquss' => [
            
            /*
            |--------------------------------------------------------------------------
            | Disquss short name
            |--------------------------------------------------------------------------
            |
            | You need to specify the Disquss short name here
            | You can find it here: http://disqus.com/admin/settings/
            |
            */
            'short_name' => '',

            'repository' => '\TypiCMS\Modules\Comments\Repositories\DisqussComment',
        ],
        'facebook' => [
            'numposts' => 5,
            /*
            |--------------------------------------------------------------------------
            | Application ID
            |--------------------------------------------------------------------------
            |
            | For moderating the comments you have to specify the APP_ID
            | Alternatively you can leave this empty and add admins
            |
            */
            'app_id' => '',

            /*
            |--------------------------------------------------------------------------
            | Moderator IDs
            |--------------------------------------------------------------------------
            |
            | If no app_id is available you can list the IDs of the moderator facebook accounts
            | You can get the numeric ID from this site for example: http://findmyfbid.com/
            |
            */
            'admins' => [],

            'repository' => '\TypiCMS\Modules\Comments\Repositories\FacebookComment',
        ]
    ]
];
