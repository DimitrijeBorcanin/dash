<?php
namespace App\Enum;

enum LocationEnum: string {
    case BEOGRAD = "Beograd";
    case KRALJEVO = "Kraljevo";

    use ListTrait;
}