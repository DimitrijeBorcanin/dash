<?php
namespace App\Enum;

trait ListTrait {
    public static function getList(){
        return array_map(fn($value) => ["title" => $value->value, "value" => $value->value], self::cases());
    }
}