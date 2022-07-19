<?php

declare(strict_types=1);

return [
    'get' => [
        'sitemap' => [
            '',
        ],
        'lang' => [
            'login',
            'login/[part]',
            'logout',
            'logout/[part]',
            'register',
            'register/[part]',
            'user',
            'user/[part]',
            'menu',
            'menu/[part]',
            'main',
            'main/[part]',
            'locations',
            'locations/[part]',
            'location',
            'location/[part]',
            'reviews',
            'reviews/[part]',
            'review',
            'review/[part]',
            'mediafiles',
            'mediafiles/[part]',
            'mediafile',
            'mediafile/[part]',
            'statistics',
            'statistics/[part]',
            'pinpowermap',
            'pinpowermap/[part]',
            'profile',
            'profile/[part]',
            'settings',
            'settings/[part]',
        ],
        'locations' => [
            '',
            '[id]',
            '[id]/edit',
            '[id]/reviews',
            '[id]/media-files',
            'filters',
        ],
        'reviews' => [
            '',
            '[id]',
            'filters',
        ],
        'media-files' => [
            '',
            '[id]',
            'filters',
        ],
        'auth' => [
            'login',
            'logout',
            'user/get',
        ],
    ],
    'post' => [
        'locations' => [
            '[id]',
        ],
        'reviews' => [
            '[id]',
        ],
        'media-files' => [
            '[id]',
        ],
        'auth' => [
            'register',
        ],
    ],
    'put' => [
        'locations' => [
            '[id]',
        ],
        'media-files' => [
            '[id]',
        ],
    ],
    'delete' => [
        'locations' => [
            '[id]',
        ],
        'media-files' => [
            '[id]',
        ],
    ],
];
