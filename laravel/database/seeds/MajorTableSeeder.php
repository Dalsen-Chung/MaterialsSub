<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('major')->insert([
            'MajorName' => '电气工程及其自动化',
            'MajorCode' => '080601',
            'MajorDep' => '电气与计算机工程学院'
        ]);

    }
}
