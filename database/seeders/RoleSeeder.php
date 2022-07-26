<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $roles = [
        [
            "id" => 1,
            "name" => "Administrator"
        ],
        [
            "id" => 2,
            "name" => "Marketing"
        ],
        [
            "id" => 3,
            "name" => "Prodaja"
        ],
        [
            "id" => 4,
            "name" => "Proizvodnja"
        ],
        [
            "id" => 5,
            "name" => "Magacin"
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->roles as $r){
            Role::create($r);
        }
    }
}
