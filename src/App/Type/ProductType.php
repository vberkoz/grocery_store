<?php

namespace App\Type;

use App\DB;
use App\Types;
use GraphQL\Type\Definition\ObjectType;

class ProductType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => 'Product',
            'fields' => function() {
                return [
                    'id' => [
                        'type' => Types::int(),
                        'description' => 'Product identificator'
                    ],
                    'title' => [
                        'type' => Types::string(),
                        'description' => 'Product title'
                    ],
                    'category_id' => [
                        'type' => Types::int(),
                        'description' => 'Product category identificator'
                    ],
                    'product_id' => [
                        'type' => Types::string(),
                        'description' => 'Product code'
                    ],
                    'price' => [
                        'type' => Types::float(),
                        'description' => 'Product price'
                    ],
                    'availability' => [
                        'type' => Types::int(),
                        'description' => 'Product availability'
                    ],
                    'visibility' => [
                        'type' => Types::int(),
                        'description' => 'Product visibility'
                    ],
                    'image' => [
                        'type' => Types::string(),
                        'description' => 'Product image'
                    ],
                    'volume' => [
                        'type' => Types::float(),
                        'description' => 'Default volume'
                    ],
                    'volume_min' => [
                        'type' => Types::float(),
                        'description' => 'Minimal volume'
                    ],
                    'unit' => [
                        'type' => Types::string(),
                        'description' => 'Product measure unit'
                    ]
                ];
            }
        ];
        parent::__construct($config);
    }
}