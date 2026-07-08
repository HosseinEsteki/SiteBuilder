<?php

return [
    'default' => env('IRPAYMENT_DRIVER_DEFAULT', env('PAYMENT_DRIVER', 'zarinpal')),

    'drivers' => [
        'zarinpal' => [
            'merchant_id' => env('IRPAYMENT_ZARINPAL_MERCHANT_ID', env('PAYMENT_MERCHANT_ID', '')),
            'currency' => env('IRPAYMENT_ZARINPAL_CURRENCY', 'IRT'),
        ],
        'payping' => [
            'token' => env('IRPAYMENT_PAYPING_TOKEN', ''),
            'currency' => env('IRPAYMENT_PAYPING_CURRENCY', 'IRT'),
        ],
    ],
];
