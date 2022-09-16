<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function getCurrentStatusAttribute(){
        if($this->attributes["delivery"] != null){
            return "Isporučeno";
        } else if($this->attributes["warehouse"] != null){
            return "U magacinu";
        } else if($this->attributes["transit"] != null){
            return "U tranzitu";
        } else if($this->attributes["made"] != null){
            return "Proizvedeno";
        } else if($this->attributes["manufacture"] != null){
            return "U proizvodnji";
        } 
        else if($this->attributes["accepted"] != null){
            return "Za proizvodnju";
        }
        return "Aktivno";
    }

    public function getCurrentStatusNumberAttribute(){
        if($this->attributes["delivery"] != null){
            return 6;
        } else if($this->attributes["warehouse"] != null){
            return 5;
        } else if($this->attributes["transit"] != null){
            return 4;
        } else if($this->attributes["made"] != null){
            return 3;
        } else if($this->attributes["manufacture"] != null){
            return 2;
        } 
        else if($this->attributes["accepted"] != null){
            return 1;
        }
        return 0;
    }

    public function getAcceptedAttribute(){
        if($this->attributes["accepted"]){
            return Carbon::parse($this->attributes['accepted'])->format('H:i d.m.Y.');
        }
    }

    public function getManufactureAttribute(){
        if($this->attributes["manufacture"]){
            return Carbon::parse($this->attributes['manufacture'])->format('H:i d.m.Y.');
        }
    }

    public function getMadeAttribute(){
        if($this->attributes["made"]){
            return Carbon::parse($this->attributes['made'])->format('H:i d.m.Y.');
        }
    }

    public function getTransitAttribute(){
        if($this->attributes["transit"]){
            return Carbon::parse($this->attributes['transit'])->format('H:i d.m.Y.');
        }
    }

    public function getWarehouseAttribute(){
        if($this->attributes["warehouse"]){
            return Carbon::parse($this->attributes['warehouse'])->format('H:i d.m.Y.');
        }
    }

    public function getDeliveryAttribute(){
        if($this->attributes["delivery"]){
            return Carbon::parse($this->attributes['delivery'])->format('H:i d.m.Y.');
        }
    }

    public function getPaidAttribute(){
        if($this->attributes["paid"]){
            return Carbon::parse($this->attributes['paid'])->format('H:i d.m.Y.');
        }
    }

    public function getFormattedCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('d.m.Y.');
    }

    public function getFormattedMonthLaterAttribute(){
        return Carbon::parse($this->attributes['created_at'])->addDays(30)->format('d.m.Y.');
    }

    public function scopeActive($query)
    {
        return $query->whereNull('paid');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
