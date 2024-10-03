<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class contrat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Contrat::insert([
        ["type"=>'CDD'],
        ["type"=>'CDI'],
        ["type"=>'ANAPEC'],
    ]);
    }
}
