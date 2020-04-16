<?php

use Illuminate\Database\Seeder;
use App\Branch;
use App\Indicator;
use App\Quantity;
use App\Resource;

class QuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = Branch::all();
        $resources = Resource::all();
        $indicators = Indicator::all();

        $list = [];

        foreach ($branches as $branch) {

            // resources
            foreach ($resources as $resource) {
                $list [] = [
                    'branch_id' => $branch->id,
                    'target_type' => Resource::class,
                    'target_id' => $resource->id,
                    'value' => rand(100, 1000) * 1000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // indicators
            foreach ($indicators as $indicator) {
                $list [] = [
                    'branch_id' => $branch->id,
                    'target_type' => Indicator::class,
                    'target_id' => $indicator->id,
                    'value' => rand(2, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

        }

        Quantity::insert($list);

    }
}
