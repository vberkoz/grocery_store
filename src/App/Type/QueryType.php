<?php

namespace App\Type;

use App\DB;
use App\Types;
use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function() {
                return [
                    'user' => [
                        'type' => Types::user(),
                        'description' => 'Get user by id',
                        'args' => [
                            'id' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            return DB::selectOne("SELECT * from users WHERE id = {$args['id']}");
                        }
                    ],
                    'allUsers' => [
                        'type' => Types::listOf(Types::user()),
                        'description' => 'User list',
                        'resolve' => function () {
                            return DB::select('SELECT * from users');
                        }
                    ],
                    'products' => [
                        'type' => Types::product(),
                        'description' => 'Get product by id',
                        'args' => [
                            'id' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            return DB::selectOne("SELECT * from products WHERE id = {$args['id']}");
                        }
                    ],
                    'allProducts' => [
                        'type' => Types::listOf(Types::product()),
                        'description' => 'Product list',
                        'resolve' => function () {
                            return DB::select('SELECT * from products');
                        }
                    ]
                ];
            }
        ];
        parent::__construct($config);
    }
}