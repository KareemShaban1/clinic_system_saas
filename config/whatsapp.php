<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WhatsApp Notifications
    |--------------------------------------------------------------------------
    |
    | Configuration for WhatsApp notifications using Hypersender
    |
    */

    'enabled' => env('WHATSAPP_ENABLED', true),

    'hypersender' => [
        'instance_id' => env('WHATSAPP_INSTANCE_ID', '9f019bb4-dc27-4d6f-bb58-4e627e1cabfb'),
        'token' => env('WHATSAPP_TOKEN', '240|6CASHwjIGSUGGHVDuPpZCZKfivVV8kixl7aIPOFc53b42a26'),
    ],

    'default_country_code' => env('WHATSAPP_DEFAULT_COUNTRY_CODE', '+20'), // Egypt

    'messages' => [
        'credentials' => [
            'enabled' => env('WHATSAPP_CREDENTIALS_ENABLED', true),
        ],
        'appointment_reminder' => [
            'enabled' => env('WHATSAPP_APPOINTMENT_REMINDER_ENABLED', true),
        ],
    ],
];
