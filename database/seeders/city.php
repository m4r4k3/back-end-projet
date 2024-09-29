<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class city extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\City::insert([
        ["name"=>'casablanca'],
        ["name"=>'rabat'],
        ["name"=>'agadir'],
        ["name"=>'tangier']
    ]);
    }
}
