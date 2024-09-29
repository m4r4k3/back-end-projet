<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offres;

class demadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offres::create([
            'user_id' => 0,
            'city' => 'New York',
            'post' => 'Software Engineer',
            'salary' => 80000,
            'domain_id' => 1,
            'description' => 'Develop and maintain software applications.',
            'characteristic' => 'Team player, problem solver',
            'type_contrat' => 1,
            'starting' => '2024-06-01',
        ]);

        Offres::create([
            'user_id' => 0,
            'city' => 'San Francisco',
            'post' => 'Product Manager',
            'salary' => 90000,
            'domain_id' => 2,
            'description' => 'Manage product lifecycle and development.',
            'characteristic' => 'Leadership, communication',
            'type_contrat' => 2,
            'starting' => '2024-07-01',
        ]);

        Offres::create([
            'user_id' => 0,
            'city' => 'Chicago',
            'post' => 'Data Analyst',
            'salary' => 70000,
            'domain_id' => 3,
            'description' => 'Analyze and interpret complex data sets.',
            'characteristic' => 'Analytical, detail-oriented',
            'type_contrat' => 1,
            'starting' => '2024-08-01',
        ]);
    }
}
