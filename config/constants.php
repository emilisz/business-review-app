<?php

return [
    'paginate_by' => [
        'default' => 10,
        'profile' => [
            'businesses' => 3,
            'payments' => 3,
            'ratings' => 3,
        ],
    ],
    'premium_price' => 5.55,
    'premium_days' => 30,
    'payments_providers' => [
        'paypal' => ['api_key' => env('PAYPAL_API_KEY', '')],
        'stripe' => ['api_key' => env('STRIPE_API_KEY', '')]
    ],

];

