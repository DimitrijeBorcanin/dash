<?php
namespace App\Enum;

enum TopTypeEnum: string {
    case MERMER = "Mermer";
    case KERAMIKA = "Keramika";
    case PORCELAN = "Porcelan";
    case HRAST = "Hrast";
    case STAKLO = "Staklo";

    use ListTrait;
}