<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function getAddressAndCityAttribute(){
        $address = $this->attributes["address"];
        $city = $this->attributes["city"];

        if(empty($address) && empty($city)){
            return null;
        }

        if(empty($address)){
            return $city;
        }

        if(empty($city)){
            return $address;
        }

        return $address . ', ' . $city;
    }
}
