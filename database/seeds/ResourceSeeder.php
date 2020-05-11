<?php

use Illuminate\Database\Seeder;
use App\Resource;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            'آب' => 'مترمکعب',
            'برق' => 'کیلو وات ساعت',
            'گاز' => 'مترمکعب',
            'سوخت' => 'مترمکعب',
            'تلفن' => 'ریال',
        ];

        foreach ($list as $name => $unit) {
            Resource::create(compact('name', 'unit'));
        }
    }
}
