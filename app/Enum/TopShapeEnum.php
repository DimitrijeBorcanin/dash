<?php
namespace App\Enum;

enum TopShapeEnum: string {
    case KRUZNA = "Kružna";
    case KONKORD = "Konkord";
    case PRAVOUGAONIK = "Pravougaonik";
    case NEPRAVILAN = "Nepravilan oblik";
}