<?php
namespace App\Enum;

enum CurrencyEnum: string {
    case EUR = "EUR";
    case RSD = "RSD";

    use ListTrait;
}