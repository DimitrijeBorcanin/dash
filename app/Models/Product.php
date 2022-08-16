<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function getFormattedTransportAttribute(){
        return number_format($this->attributes['transport'], 2, ',', '.');
    }

    public function getFormattedPriceAttribute(){
        return number_format($this->attributes['price'], 2, ',', '.');
    }

    public function getFormattedDepositAttribute(){
        return number_format($this->attributes['deposit'], 2, ',', '.');
    }

    public function getAmountWithCurrency($column){
        return number_format($this->{$column}, 2, ',', '.') . ' ' . $this->currency;
    }

    public function order(){
        return $this->hasOne(Order::class);
    }
}