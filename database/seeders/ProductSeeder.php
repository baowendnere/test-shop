<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "designation" => "Sac à main1",
            "description" => "La description du sac à main",
            "prix" => 45000
        ]);

        Product::create([
            "designation" => "Ordinateur1",
            "description" => "La description de l'ordinateur",
            "prix" => 300000
        ]);

        Product::create([
            "designation" => "Téléphone1",
            "description" => "La description du téléphone",
            "prix" => 100000
        ]);
    }
}
