<?php
namespace App\Enum;

enum QuantityEnum : string {
    case JEDAN = "1";
    case DVA = "2";
    case TRI = "3";
    case JEDAN_S = "1 set";
    case DVA_S = "2 seta";
    case TRI_S = "3 seta";

    use ListTrait;
}