<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeContrat ;

class TypeContratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeContrat::insert(
            [
                ['type' => "CDI"],
                ['type' => "CDD"],
                ['type' => "CDD d'usage"],
                ['type' => "CDD de remplacement"],
                ['type' => "CDD saisonnier"],
            ]
        );
    }
}
