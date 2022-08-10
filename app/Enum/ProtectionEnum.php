<?php
namespace App\Enum;

enum ProtectionEnum: string {
    case BEZ = "Bez zaštite";
    case NANO = "Nano";
    case CINK = "Cinkovanje";

    use ListTrait;
}