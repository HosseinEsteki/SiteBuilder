<?php
return [
    'sku' => 'شناسه‌محصول',

    'active' => [
        'label' => 'فعال؟',
        'true' => 'فعال',
        'false' => 'غیرفعال',
        'change' => 'تغییر وضعیت'
    ],
    'discount' => [
        'title' => 'کد تخفیف',
        'value' => 'مقدار',
        'type' => 'نوع تخفیف',
        'conditions' => [
            'label' => 'شروط',
            'min_total' => 'حداقل خرید',
            'min_items' => 'حداقل تعداد'
        ],

        'filter' => [
            'date' => [
                'label' => 'تاریخ اعتبار',
                'start_date' => 'تاریخ شروع',
                'end_date' => 'تاریخ پایان',
            ],
        ],
        'start_date' => 'شروع تخفیف',
        'end_date' => 'پایان تخفیف',
        'usage_limit' => 'محدودیت استفاده',
        'used_count' => 'استفاده شده',
        'discountType' => [
            'percentage' => 'درصدی',
            'fixed' => 'عدد ثابت',
            'free_shipping' => 'ارسال رایگان',
            'conditional' => 'حداقل خرید',
        ]
    ],
    'orders' => [
        'status' => [
            'changeStatus' => 'تغییر وضعیت',
            'label' => 'وضعیت سفارش',
            'pending' => 'در انتظار پرداخت',
            'processing' => 'در حال پردازش',
            'paid' => 'پرداخت شده',
            'shipped' => 'ارسال شده',
            'completed' => 'تکمیل شده',
            'cancelled' => 'لغو شده',
        ],
        'shipping' => [
            'receiver' => 'دریافت کننده',
            'total' => 'هزینه حمل‌و‌نقل',
            'address' => 'آدرس حمل‌و‌نقل',
            'code' => 'کد رهگیری حمل‌و‌نقل'
        ],
        'quantity' => 'تعداد',
        'items' => 'موارد سفارش',
        'buyer' => 'خریدار',
        'payment_ref' => 'کد رهگیری پرداخت'
    ],
    'products' => [
        'types' => [
            'name' => 'نوع محصول',
            'simple' => 'محصول ساده',
            'variable' => 'محصول متغیر',
        ],
        'name' => 'نام محصول',
        'stock' => 'موجودی',
        'count' => 'تعداد محصولات',
    ],
    'money' => [
        'original_total' => 'جمع کل',
        'total_price' => 'قیمت نهایی',
        'price' => 'قیمت',
        'cost'=>'هزینه',
        'sale_price' => 'قیمت فروش',
        'discount' => 'تخفیف',
        'currency' => 'تومان'
    ],
    'features' => [
        'index' => 'ویژگی‌ها',
        'show' => 'ویژگی',
        'create' => 'افزودن ویژگی جدید',
        'featureName' => 'نام ویژگی',
        'values' => [
            'index' => 'مقادیر ویژگی',
            'create' => 'افزودن مقدار جدید',
        ],
    ],
    'variants' => [
        'list' => 'لیست واریانت ها',
        'index' => 'واریانت ها',
        'show' => 'واریانت',
        'values' => 'مقادیر ویژگی این واریانت',
        'create' => 'افزودن واریانت جدید',
    ],

    'brand' => [
        'create' => 'افزودن برند',
        'label' => 'برند',
    ],

];
