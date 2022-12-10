<?php

return [
    'payment_providers' => [
        'stripe',
        'paypal'
    ],
    'pagination_number' => [
        'default' => 10,
        'profile' => [
            'businesses' => 2,
            'payments' => 2,
            'ratings' => 2,
        ],
    ],

    'premium_price' => 5.55,
    'premium_days' => 30,
];

