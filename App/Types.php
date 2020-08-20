<?php

namespace App;

use App\Type\QueryType;
use App\Type\UserType;
use App\Type\ProductType;
use GraphQL\Type\Definition\Type;

class Types
{
    private static $query;
    private static $user;
    private static $product;

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function user()
    {
        return self::$user ?: (self::$user = new UserType());
    }

    public static function product()
    {
        return self::$product ?: (self::$product = new ProductType());
    }

    public static function int()
    {
        return Type::int();
    }

    public static function float()
    {
        return Type::float();
    }

    public static function string()
    {
        return Type::string();
    }

    public static function listOf($type)
    {
        return Type::listOf($type);
    }
}