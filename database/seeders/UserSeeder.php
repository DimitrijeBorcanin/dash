<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $admin = [
        "id" => 1,
        "name" => "Admin",
        "email" => "admin@admin.com",
        "password" => "$2a$12$/slTx0xIr.YSilp9JcUvdeTqqkZGVQzn8oEql0RN2/sW2M8YucnXe",
        "role_id" => 1
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create($this->admin);
    }
}
