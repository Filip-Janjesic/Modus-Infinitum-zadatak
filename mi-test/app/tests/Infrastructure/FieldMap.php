<?php

namespace App\Infrastructure;

class FieldMap
{
    public const USER_FIELD_MAP = [
        'name' => 'user_name',
        'age' => 'user_age',
        'city' => 'user_city'
    ];

    public const PRODUCT_FIELD_MAP = [
        'name' => 'product_name',
        'price' => 'product_price',
        'category' => 'product_category'
    ];
}
