<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            'kermanshah' => 'کرمانشاه',
            'eslam-abad' => 'اسلام‌آباد غرب',
            'sarpol' => 'سرپل ذهاب',
            'songhor' => 'سنقر',
            'harsin' => 'هرسین',
            'kangavar' => 'کنگاور',
            'javanrood' => 'جوانرود',
            'sahneh' => 'صحنه',
            'paveh' => 'پاوه',
            'gilan-gharb' => 'گیلانغرب',
            'ravansar' => 'روانسر',
            'dalahoo' => 'دالاهو',
            'salas' => 'ثلاث باباجانی',
            'ghasr' => 'قصرشیرین',
        ];

        foreach ($list as $english => $persian) {

            $user = User::create([
                'name' => $english,
                'password' => bcrypt($english),
                'type' => 'branch',
            ]);

            $branch = Branch::create([
                'user_id' => $user->id,
                'name' => $persian,
            ]);

        }
    }
}
