<?php

return [

    'name' => env('SITE_NAME', 'GraceOfBeauty'),
    'motto' => env('SITE_MOTTO', 'A form of Elegances'),
    'tagline' => env('SITE_TAGLINE', 'Hair Salon & Spa'),
    'company_acronym' => env('COMPANY_ACRONYM', 'GoB.'),
    'owner' => [
        'name' => env('OWNER_NAME', 'Janeth Malikita'),
        'welcome_note' => env('OWNER_WELCOME_NOTE', 'Relax, unwind, and treat yourself to the care you deserve. Your beauty journey starts here — and we’re delighted to be part of it. ✨'),
    ],

   'contact' => [
        'phone' => env('SITE_PHONE', '(+255) 659 920 815'),
        'phone_short' => env('SITE_PHONE_SHORT', '(+255) 659 920 815'),
        'email' => env('SITE_EMAIL', 'janethmalikita@gmail.com'),
        'address' => env('SITE_ADDRESS', 'Ihumwa Kwa Juli, P.O. Box 283 Dodoma, Tanzania'),
        'location_code' => env('SITE_LOCATION_CODE', 'VV4X+88C, Ihumwa'),
    ],

    'opening_hours' => [
        'weekdays' => [
            'label' => 'Monday - Friday',
            'hours' => '10.00 - 23.00',
        ],
        'saturday' => [
            'label' => 'Saturday',
            'hours' => '10.00 - 19.00',
        ],
        'sunday' => [
            'label' => 'Sunday',
            'hours' => 'Closed',
        ],
    ],

    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK', '#'),
        'twitter' => env('SOCIAL_TWITTER', '#'),
        'google' => env('SOCIAL_GOOGLE', '#'),
        'instagram' => env('SOCIAL_INSTAGRAM', '#'),
        'youtube' => env('SOCIAL_YOUTUBE', '#'),
        'linkedin' => env('SOCIAL_LINKEDIN', '#'),
    ],

];
