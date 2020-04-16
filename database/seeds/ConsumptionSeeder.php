<?php

use Illuminate\Database\Seeder;
use App\Resource;
use App\Branch;
use App\Consumption;
use App\Quantity;

class ConsumptionSeeder extends Seeder
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
        $years = [1397, 1398];
        $list = [];

        foreach ($branches as $branch) {
            foreach ($resources as $resource) {

                $quantity = Quantity::where('target_type', Resource::class)
                    ->where('branch_id', $branch->id)->where('target_id', $resource->id)->first();

                if ($quantity) {

                    $target = $quantity->value;

                    foreach ($years as $year) {
                        for ($month = 1; $month <= 12 ; $month++) {

                            $list [] = [
                                'branch_id' => $branch->id,
                                'resource_id' => $resource->id,
                                'target' => $target,
                                'amount' => rand($target-50000, $target+50000),
                                'month' => $month,
                                'year' => $year,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];

                        }
                    }
                }

            }
        } // end of first foreach

        Consumption::insert($list);

    }
}
