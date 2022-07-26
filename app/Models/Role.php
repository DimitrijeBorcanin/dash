<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ["id", "name"];

    public function users(){
        return $this->hasMany(User::class);
    }

    protected static function booted(){
        static::addGlobalScope('notadmin', function (Builder $builder){
            $builder->where('id', '!=', 1);
        });
    }
}
