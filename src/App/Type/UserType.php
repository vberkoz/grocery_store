<?php

namespace App\Type;

use App\DB;
use App\Types;
use GraphQL\Type\Definition\ObjectType;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => 'User',
            'fields' => function() {
                return [
                    'id' => [
                        'type' => Types::int(),
                        'description' => 'User identificator'
                    ],
                    'email' => [
                        'type' => Types::string(),
                        'description' => 'User E-mail'
                    ],
                    'username' => [
                        'type' => Types::string(),
                        'description' => 'User name'
                    ],
                    'address' => [
                        'type' => Types::string(),
                        'description' => 'Delivery address'
                    ],
                    'role' => [
                        'type' => Types::string(),
                        'description' => 'User system role'
                    ]
                ];
            }
        ];
        parent::__construct($config);
    }
}