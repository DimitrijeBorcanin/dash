<?php
namespace App\Enum;

enum HeightEnum: string {
    case STANDARD = "Standardna";

    use ListTrait;
}