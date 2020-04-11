<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Product;
use App\User;

class ProductsTableSeeder extends Seeder
{
  public function run()
      {
          Product::truncate();

          $faker = \Faker\Factory::create();
          $users = User::all()->pluck('id');

          for ($i = 0; $i < 50; $i++) {
              Product::create([
                  'name' => $faker->text($maxNbChars = 20, $minNbChars = 2),
                  'description' => $faker->text($maxNbChars = 16000),
                  'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.00, $max = 100000.00),
                  'active' => $faker->boolean(30),
                  'user_id' => $faker->randomElement($users),
              ]);
          }
      }
}
