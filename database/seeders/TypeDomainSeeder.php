<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Domain ;
class TypeDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Domain::insert( [
            ["domain"=>"Information Technology (IT)"],
            ["domain"=>"Healthcare"],
            ["domain"=>"Finance and Banking"],
            ["domain"=>"Education"],
            ["domain"=>"Manufacturing"],
            ["domain"=>"Retail and E-commerce"],
            ["domain"=>"Marketing and Advertising"],
            ["domain"=>"Engineering"],
            ["domain"=>"Consulting"],
            ["domain"=>"Hospitality and Tourism"]
           ]); 
    }
}
