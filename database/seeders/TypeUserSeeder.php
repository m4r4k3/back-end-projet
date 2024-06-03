<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeUser ;
class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeUser::insert([
            ["type"=>"entreprise"],
            ["type"=>"individual"]
        ]);
    }
}
