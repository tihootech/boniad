<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BranchSeeder::class);
        $this->call(IndicatorSeeder::class);
        $this->call(ResourceSeeder::class);
        $this->call(QuantitySeeder::class);
    }
}
